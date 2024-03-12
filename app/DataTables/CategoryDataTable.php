<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn("image", function ($query) {
                $img = " <img alt='$query->name' width='300' src='" . asset($query->image) . " '/> ";
                return $img;
            })
            ->addColumn("status", function ($query) {
                if ($query->status == 1) {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" checked data-url=" ' . route("admin.category.change-status", $query->id) . '" class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                } else {
                    return
                        '<label class="custom-switch mt-2">
                            <input type="checkbox" data-url=" ' . route("admin.category.change-status", $query->id) . '"  class="status custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>';
                }
            })
            ->addColumn('action', function ($query) {
                $updateBtn = "<a href = '" . route("admin.category.edit", $query->id) . " ' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i> </a> &emsp;";
                $deleteBtn = "<button class='delete btn btn-danger' data-url='".route("admin.category.destroy", $query->id) ."'><i class='fa-solid fa-trash-can-arrow-up'></i></button>"; 
                return $updateBtn . $deleteBtn;
            })
            ->addColumn('icon', function ($query) {
                return "<i style='font-size:40px' class='$query->icon'> </i>";
            })
            ->rawColumns(["icon", "action", "status","image"])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
            Column::make('image')->width(300),
            Column::computed('icon')->width(100),
            Column::make('name'),
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
        return 'Category_' . date('YmdHis');
    }
}
