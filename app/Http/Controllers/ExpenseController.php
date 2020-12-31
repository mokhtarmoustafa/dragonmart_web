<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Http\Requests\expense\CreateRequest;
use App\Http\Requests\expense\UpdateRequest;
use App\Repositories\Eloquents\ExpenseEloquent;

class ExpenseController extends Controller
{
    //
    private $expense;

    public function __construct(ExpenseEloquent $expense)
    {
        parent::__construct();
        $this->expense = $expense;
    }

    public function index()
    {

        $total_expense = Expense::sum('amount');

        $data = [
            'main_title' => 'Expense',
            'sub_title' => 'expense cost',
            'total_expense' => doubleval($total_expense),
            'icon' => 'fa fa-ship'
        ];

        return view(admin_vw() . '.expenses.index', $data);
    }

    public function expensesData()
    {
        return $this->expense->anyData();
    }

    public function getExpense($id)
    {
        return $this->expense->getById($id);
    }

    public function saveExpense(CreateRequest $request, $id = null)
    {
        if (isset($id)) {
            return $this->expense->update($request->all(), $id);
        }
        return $this->expense->create($request->all());
    }

    public function edit($id)
    {

        $expense = $this->expense->getById($id);

        $html = 'This expense cost does not exist';
        if (isset($expense)) { // && $expense->merchant_id == auth()->guard('admin')->user()->user_id
            $view = view()->make('modal', [
                'modal_id' => 'edit-expense',
                'modal_title' => 'Edit expense cost',
                'form' => [
                    'method' => 'POST',
                    'url' => url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/expense/' . $expense->id),
                    'form_id' => 'save_expense_frm',
                    'fields' => [
                        'amount' => 'number',
                        'expense_date' => 'date',
                        'details' => 'textarea',
                    ],
                    'values' => [
                        'amount' => $expense->amount,
                        'expense_date' => $expense->expense_date,
                        'details' => $expense->details,
                    ],
                    'fields_name' => [
                        'amount' => 'Amount (SAR)',
                        'expense_date' => 'Date',
                        'details' => 'Details',
                    ]
                ]
            ]);

            $html = $view->render();
        }
        return $html;
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->expense->update($request->all(), $id);
    }


//
    public function create()
    {
        $view = view()->make('modal', [
            'modal_id' => 'add-expense',
            'modal_title' => 'Add New expense',
            'form' => [
                'method' => 'POST',
                'url' => url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/expense'),
                'form_id' => 'save_expense_frm',
                'fields' => [
                    'amount' => 'number',
                    'expense_date' => 'date',
                    'details' => 'textarea',

                ],
                'fields_name' => [
                    'amount' => 'Amount (SAR)',
                    'expense_date' => 'Date',
                    'details' => 'Details',
                ]
            ]
        ]);

        $html = $view->render();

        return $html;
    }

//
    public function store(CreateRequest $request)
    {
        return $this->expense->create($request->all());
    }

    public function delete($id)
    {
        return $this->expense->delete($id);
    }
}
