<?php

namespace App\DataTables;

use App\Models\County;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountyDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $edit = "<a href='".route('admin.counties.edit', $query->id)."' class='btn btn-sm btn-primary me-1 '><i class='fa fa-edit'></i></a>";
                $delete = "<a href='".route('admin.counties.destroy', $query->id)."' class='btn btn-sm btn-danger delete-item' id='delete'><i class='fa fa-trash'></i></a>";

                return $edit.$delete;
            })->addColumn('image', function ($query) {
                return '<img src="'.asset($query->image).'" width="50" height="50" />';
            })

            ->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(County $model): QueryBuilder
    {
        return $model->orderBy('name', 'asc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                ->addTableClass('myDataTable table table-hover align-middle mb-0')
                ->setTableId('category-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                //->dom('Bfrtip')
                ->orderBy(0, 'asc')
                ->selectStyleSingle()
                ->language([
                    'url' => url('vendor/datatables/i18n/Turkish.json')
                ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex') // This will show the row number
            ->title('#')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-start'),
            Column::make('image')->title('Resim')->width(150),
            Column::make('name')->title('İlçe adı'),
            Column::computed('action')
                ->title('İşlem')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'County_' . date('YmdHis');
    }
}
