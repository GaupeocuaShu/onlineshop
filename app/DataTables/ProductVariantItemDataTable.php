<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $role = Auth::user()->role;
        return (new EloquentDataTable($query))
            ->addColumn('status', function ($query) use ($role) {
                if ($query->status == 1) {
                    return
                        '<label class="custom-switch mt-2">
                    <input type="checkbox" checked data-url=" ' . route("$role.product.variant.item.change_status", $query->id) . '" class="status custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                    <input type="checkbox" data-url=" ' . route("$role.product.variant.item.change_status", $query->id) . '"  class="status custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                </label>';
                }
            })
            ->addColumn('is_default', function ($query) use ($role) {
                if ($query->is_default == 1) {
                    return
                        '<label class="custom-switch mt-2">
                    <input name="is_default" type="radio" checked data-url=" ' . route("$role.product.variant.item.is_default", $query->id) . '" class="isdefault custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                    <input name="is_default" type="radio" data-url=" ' . route("$role.product.variant.item.is_default", $query->id) . '"  class="isdefault custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                </label>';
                }
            })
            ->addColumn('action', function ($query) use ($role) {
                $updateBtn = "<a href = '" . route("$role.product.variant.item.edit", [$query->productVariant->product_id, $query->product_variant_id, $query->id]) . " ' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;";
                $deleteBtn = "<button class='delete btn btn-danger' data-url='". route("$role.product.variant.item.destroy", [$query->productVariant->product_id, $query->product_variant_id, $query->id]) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $updateBtn . $deleteBtn;
            })
            ->rawColumns(["action", "status", "is_default"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return ProductVariantItem::where("product_variant_id", $this->variantID);
    }


    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
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
            Column::make('id')->width(50),
            Column::make('name'),
            Column::computed('price'),
            Column::computed('is_default'),
            Column::computed('status'),
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
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
