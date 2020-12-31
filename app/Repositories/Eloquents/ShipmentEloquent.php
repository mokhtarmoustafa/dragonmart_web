<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\ShipmentCost;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class ShipmentEloquent extends Uploader implements Repository
{

    private $model, $notification;

    public function __construct(ShipmentCost $model, NotificationEloquent $notificationEloquent)
    {
        $this->model = $model;
        $this->notification = $notificationEloquent;
    }

    // for cpanel
    function anyData()
    {
        if (getAuth()->type == 'admin')
            $shipments = $this->model->where('type', getAuth()->type)->orderBy('from', 'ASC');
        else
            $shipments = $this->model->where('type', getAuth()->type)->where('merchant_id', getAuth()->user_id)->orderBy('from', 'ASC');
        return datatables()->of($shipments)
            ->filter(function ($query) {

//                if (request()->filled('search')) {
//                    $search = request()->get('search');
//                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
//                }

            })
            ->addColumn('from_to', function ($shipment) {
                return $shipment->from . ' - ' . $shipment->to;
            })
            ->addColumn('action', function ($shipment) {
                return '<a href="' . url(getAuth()->type . '/shipment/' . $shipment->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-shipment-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/shipment/' . $shipment->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        $shipments = $this->model->all();
        if (request()->segment(1) == 'api')
            return response_api(true, 200, null, $shipments);
        return $shipments;
    }


    function getById($id)
    {
        $shipment = $this->model->find($id);

        return $shipment;
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $shipment = new ShipmentCost();
        if (getAuth()->type == 'merchant')
            $shipment->merchant_id = getAuth()->user_id;
        $shipment->price = $attributes['price'];
        $shipment->from = $attributes['from'];
        $shipment->to = $attributes['to'];
        $shipment->type = getAuth()->type;
        if (isset($attributes['min_order_amount']))
            $shipment->min_order_amount = $attributes['min_order_amount'];
        if ($shipment->save()) {

            if (getAuth()->type == 'merchant')
                $this->notification->addAdminNotification('The merchant added new shipping rate');
            return response_api(true, 200);
        }
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.

        if (getAuth()->type == 'admin')
            $shipment = $this->model->where('type', getAuth()->type)->find($id);
        else
            $shipment = $this->model->where('type', getAuth()->type)->where('merchant_id', getAuth()->user_id)->find($id);


        if (!isset($shipment))
            return response_api(false, 422);

        if (isset($attributes['price']))
            $shipment->price = $attributes['price'];
        if (isset($attributes['from']))
            $shipment->from = $attributes['from'];
        if (isset($attributes['to']))
            $shipment->to = $attributes['to'];

        if (isset($attributes['min_order_amount']))
            $shipment->min_order_amount = $attributes['min_order_amount'];

        if ($shipment->save()) {
            if (getAuth()->type == 'merchant')
                $this->notification->addAdminNotification('The merchant edited shipping rate');

            return response_api(true, 200);
        }

        return response_api(false, 422);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        if (getAuth()->type == 'admin')
            $shipment = $this->model->where('type', getAuth()->type)->find($id);
        else
            $shipment = $this->model->where('type', getAuth()->type)->where('merchant_id', getAuth()->user_id)->find($id);

        if (isset($shipment) && $shipment->delete()) {

            if (getAuth()->type == 'merchant')
                $this->notification->addAdminNotification('The merchant deleted shipping rate');

            return response_api(true, 200);
        }
        return response_api(false, 422);

    }


}
