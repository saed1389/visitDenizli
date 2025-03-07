<?php

namespace App\DataTables;

use App\Models\TourismOffice;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TourismOfficeDataTable extends DataTable
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
                $edit = "<a href='".route('admin.tourism-office.edit', $query->id)."' class='btn btn-sm btn-primary me-1 '><i class='fa fa-edit'></i></a>";
                $delete = "<a href='".route('admin.tourism-office.destroy', $query->id)."' class='btn btn-sm btn-danger delete-item' id='delete'><i class='fa fa-trash'></i></a>";

                return $edit.$delete;
            })->addColumn('image', function ($query) {
                return '<img src="'.asset($query->image).'" width="50" height="50" />';
            })->addColumn('status', function (TourismOffice $office) {
                $status = $office->status == 1 ? 'checked' : '';
                return "
                <div class='form-check form-switch' style='justify-self: center;'>
                    <input class='form-check-input switch-input active' type='checkbox' data-id='{$office->id}' role='switch' {$status}>
                </div>";
            })
            ->addColumn('created_at', function (TourismOffice $office) {
                return $office->created_at->diffForHumans();
            })
            ->addColumn('county_id', function (TourismOffice $office) {
                return $office->county->name;
            })
            ->addColumn('created_by', function (TourismOffice $office) {
                return $office->createdBy->name;
            })

            ->rawColumns(['image', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(TourismOffice $model): QueryBuilder
    {
        return $model->newQuery();
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
            Column::computed('DT_RowIndex')
                ->title('#')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-start'),
            Column::make('image')
                ->title('Resim')
                ->width(150)
                ->orderable(false)
                ->searchable(false),
            Column::make('name')->title('Ofis adı'),
            Column::make('county_id')->title('İlçe'),
            Column::make('created_by')->title('Oluşturan'),
            Column::make('created_at')->title('Oluşturuldu'),
            Column::make('status')
                ->title('Onayla')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
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
        return 'TourismOffice_' . date('YmdHis');
    }
}
