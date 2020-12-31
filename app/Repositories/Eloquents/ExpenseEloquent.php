<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\Expense;
use App\expenseCost;
use App\Repositories\Interfaces\Repository;
use App\Repositories\Uploader;

class ExpenseEloquent implements Repository
{

    private $model;

    public function __construct(Expense $model)
    {
        $this->model = $model;
    }

    // for cpanel
    function anyData()
    {
        $expenses = $this->model->orderBy('created_at', 'ASC');
        return datatables()->of($expenses)
            ->filter(function ($query) {

                if (request()->filled('date_from') && request()->filled('date_to')) {
                    $query->whereDate('expense_date', '>=', request()->get('date_from'))->whereDate('expense_date', '<=', request()->get('date_to'));
                }

            })
            ->addColumn('action', function ($expense) {
                return '<a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/expense/' . $expense->id . '/edit') . '" class="btn btn-circle btn-icon-only purple edit-expense-mdl" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="' . url(((getAuth()->type == 'admin') ? admin_report_tab_url() : getAuth()->type) . '/expense/' . $expense->id) . '" class="btn btn-circle btn-icon-only red delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>';
            })->addIndexColumn()
            ->rawColumns(['icon', 'action'])->toJson();
    }

    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        $expenses = $this->model->all();
        if (request()->segment(1) == 'api')
            return response_api(true, 200, null, $expenses);
        return $expenses;
    }


    function getById($id)
    {
        $expense = $this->model->find($id);

        return $expense;
    }

    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $expense = new Expense();
        $expense->amount = $attributes['amount'];
        $expense->expense_date = $attributes['expense_date'];
        if (isset($attributes['details']))
            $expense->details = $attributes['details'];
        if ($expense->save()) {
            $total_expenses = Expense::sum('amount');
            return response_api(true, 200, null, ['total_expenses' => $total_expenses]);
        }
        return response_api(false, 422);
    }

    function update(array $attributes, $id = null)
    {
        // TODO: Implement create() method.


        $expense = $this->model->find($id);
        if (isset($attributes['amount']))
            $expense->amount = $attributes['amount'];
        if (isset($attributes['expense_date']))
            $expense->expense_date = $attributes['expense_date'];
        if (isset($attributes['details']))
            $expense->details = $attributes['details'];
        if ($expense->save()) {
            $total_expenses = Expense::sum('amount');
            return response_api(true, 200, null, ['total_expenses' => $total_expenses]);
        }

        return response_api(false, 422);

    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        $expense = $this->model->find($id);

        if (isset($expense) && $expense->delete()) {


            $total_expenses = Expense::sum('amount');
            return response_api(true, 200, null, ['total_expenses' => $total_expenses]);
        }
        return response_api(false, 422);

    }


}
