<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CompanyDatatables extends LivewireDatatable
{
    public $model = Company::class;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),
            Column::name('name')
                ->label('Name')->filterable()->searchable(),
            Column::name('ssm_no')
                ->label('SSM_No')->searchable()->filterable(),
            DateColumn::name('created_at')
                ->label('Creation Date'),
            Column::callback(['id'], function ($id) {
                return view('company.action', ['id' => $id, 'name' => 'admin']);
            })

        ];
    }
}
