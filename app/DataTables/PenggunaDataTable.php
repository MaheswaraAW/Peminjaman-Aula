<?php

namespace App\DataTables;

// use App\App\Pengguna;
use App\Pengguna;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PenggunaDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'pengguna.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Pengguna $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pengguna $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pengguna-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'id',
            'username',
            'nama',
            // 'level',
            // 'bidang',
            // 'seksi',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pengguna_' . date('YmdHis');
    }
}
