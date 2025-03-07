<?php

namespace App\DataTables;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HousingDataTable extends DataTable
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
                $edit = "<a href='".route('admin.housing.edit', $query->id)."' class='btn btn-sm btn-primary me-1 '><i class='fa fa-edit'></i></a>";
                $delete = "<a href='".route('admin.housing.destroy', $query->id)."' class='btn btn-sm btn-danger delete-item' id='delete'><i class='fa fa-trash'></i></a>";

                return $edit.$delete;
            })->addColumn('image', function ($query) {

                $images = json_decode($query->images, true);
                $firstImage = $images[0];

                return '<img src="'.asset($firstImage).'" width="50" height="50" />';
            })->addColumn('status', function (Housing $housing) {
                $status = $housing->status == 1 ? 'checked' : '';
                return "
                <div class='form-check form-switch' style='justify-self: center;'>
                    <input class='form-check-input switch-input active' type='checkbox' data-id='{$housing->id}' role='switch' {$status}>
                </div>";
            })
            ->addColumn('created_at', function (Housing $housing) {
                return $housing->created_at->diffForHumans();
            })
            ->addColumn('county_id', function (Housing $housing) {
                return $housing->county->name;
            })
            ->addColumn('created_by', function (Housing $housing) {
                return $housing->createdBy->name;
            })

            ->rawColumns(['image', 'action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Housing $model): QueryBuilder
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
            Column::make('name')->title('Konaklama adı'),
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
        return 'Housing_' . date('YmdHis');
    }
}
