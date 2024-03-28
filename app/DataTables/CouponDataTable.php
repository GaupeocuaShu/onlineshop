<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn("status", function ($query) {
                if ($query->status == 1) {
                    return
                        '<label class="custom-switch mt-2">
                        <input type="checkbox" checked data-url=" ' . route("admin.coupons.change_status", $query->id) . '" class="status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                        <input type="checkbox" data-url=" ' . route("admin.coupons.change_status", $query->id) . '"  class="status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                }
            })
            ->addColumn('discount', function ($query) {
                if ($query->discount_type == "percentage") return $query->discount . "%";
                return $query->discount . $this->currencyIcon;
            })
            ->addColumn('discount_type', function ($query) {
                if ($query->discount_type == "percentage") return "<span class='text-white badge bg-primary'>Percentage</span>";
                return "<span class='text-white badge bg-success'>Amount</span>";
            })
            ->addColumn('action', function ($query) {
                $updateBtn = "<a href = '" . route("admin.coupons.edit", $query->id) . " ' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;";
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.coupons.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $updateBtn . $deleteBtn;
            })
            ->setRowId('id')
            ->rawColumns(["action", "status", "discount_type"]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('code'),
            Column::make('discount_type'),
            Column::make('discount'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
