<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shipment\CreateRequest;
use App\Http\Requests\Shipment\UpdateRequest;
use App\Repositories\Eloquents\ShipmentEloquent;
use App\ShipmentCost;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    //
    private $shipment;

    public function __construct(ShipmentEloquent $shipment)
    {
        parent::__construct();
        $this->shipment = $shipment;
    }

    public function index()
    {

        $data = [
            'main_title' => 'constants',
            'sub_title' => 'shipping rate',
            'icon' => 'fa fa-ship',
            'constant_name' => 'shipments-data',
            'url_action' => url(current_url() . '/shipments'),
            'label' => ' shipment',
            'placeholder' => 'Shipment',
        ];

        return view(current_view() . '.shipments', $data);
    }

    public function shipmentsData()
    {
        return $this->shipment->anyData();
    }

    public function getShipment($id)
    {
        return $this->shipment->getById($id);
    }

    public function saveShipment(CreateRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->shipment->update($request->all(), $id);
        }
        return $this->shipment->create($request->all());
    }

    public function edit($id)
    {

        $shipment = $this->shipment->getById($id);

        $html = 'This shipment cost does not exist';
        if (isset($shipment)) { // && $shipment->merchant_id == auth()->guard('admin')->user()->user_id
            $view = view()->make('modal', [
                'modal_id' => 'edit-shipment',
                'modal_title' => 'Edit Shipment cost',
                'form' => [
                    'method' => 'POST',
                    'url' => url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/shipment/' . $shipment->id),
                    'form_id' => 'save_shipment_frm',
                    'fields' => [
                        'from' => 'number',
                        'to' => 'number',
                        'price' => 'number',
                        'min_order_amount' => 'number',
                    ],
                    'values' => [
                        'from' => $shipment->from,
                        'to' => $shipment->to,
                        'price' => $shipment->price,
                        'min_order_amount' => $shipment->min_order_amount,
                    ],
                    'fields_name' => [
                        'from' => 'From (km)',
                        'to' => 'To (km)',
                        'price' => 'Price (SAR)',
                        'min_order_amount' => 'Min. order amount (SAR)',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->shipment->update($request->all(), $id);
    }


//
    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-shipment',
            'modal_title' => 'Add New Shipment',
            'form' => [
                'method' => 'POST',
                'url' => url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/shipment'),
                'form_id' => 'save_shipment_frm',
                'fields' => [
                    'from' => 'number',
                    'to' => 'number',
                    'price' => 'number',
                    'min_order_amount' => 'number',

                ],
                'fields_name' => [
                    'from' => 'From (km)',
                    'to' => 'To (km)',
                    'price' => 'Price (SAR)',
                    'min_order_amount' => 'Min. order amount (SAR)',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

//
    public function store(CreateRequest $request)
    {
        return $this->shipment->create($request->all());
    }

    public function delete($id)
    {
        return $this->shipment->delete($id);
    }
}
