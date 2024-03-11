<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $updateBtn = "<a href = '" . route("admin.slider.edit", $query->id) . " ' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i> </a>";
                $deleteBtn = "<a href = '" . route("admin.slider.destroy", $query->id) . " ' class='ml-3 btn btn-danger delete-item'><i class='fa-solid fa-trash'></i> </a>";
                return $updateBtn . $deleteBtn;
            })
            ->addColumn("banner", function ($query) {

                $img = " <img width=100 src='" . asset($query->banner) . " '/> ";
                return $img;
            })
            ->addColumn("status", function ($query) {
                if ($query->status == 1) {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" checked data-url=" ' . route("admin.slider.change-status", $query->id) . '" class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" data-url=" ' . route("admin.slider.change-status", $query->id) . '"  class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                }
            })
            ->addColumn("serial", function ($query) {
                return "<input min=1 data-url = " . route("admin.slider.change-serial", $query->id) . " class='text-center serial' style='width:80px' type='number' value ='" . $query->serial . "'/>";
            })
            ->rawColumns(["banner", "action", "status", "serial"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('slider-table')
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
            Column::computed('banner')->addClass('text-center'),
            Column::make('url'),
            Column::computed('serial'),
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
        return 'Slider_' . date('YmdHis');
    }
}
