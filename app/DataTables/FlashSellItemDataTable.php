<?php

namespace App\DataTables;

use App\Models\FlashSellItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSellItemDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))


            ->addColumn('showAtHome', function ($query) {
                if ($query->show_at_home == 1) {
                    return
                        '<label class="custom-switch mt-2">
                        <input type="checkbox" checked data-url=" ' . route("admin.flash_sell.item.change_status", $query->id) . '" class="status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                        <input type="checkbox" data-url=" ' . route("admin.flash_sell.item.change_status", $query->id) . '"  class="status custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>';
                }
            })
            ->addColumn("name", function ($query) {
                return $query->product->name;
            })
            ->addColumn("image", function ($query) {

                $img = " <img width=400 src='" . asset($query->product->thumb_image) . " '/> ";
                return $img;
            })
            ->addColumn('action', function ($query) {
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.flash_sell.item.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $deleteBtn;
            })

            ->rawColumns(["image", "action", "showAtHome"])
            ->setRowId('id');
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSellItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsellitem-table')
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
            Column::make("image")->width(400),
            Column::make("name"),
            Column::make("showAtHome"),
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
        return 'FlashSellItem_' . date('YmdHis');
    }
}
