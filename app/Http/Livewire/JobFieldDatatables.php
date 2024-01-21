<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JobField;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class JobFieldDatatables extends LivewireDatatable
{
    public $model = JobField::class;

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
            Column::name('description')
                ->label('Description')->filterable()->searchable(),
            DateColumn::name('created_at')
                ->label('Creation Date'),
            Column::callback(['id'], function ($id) {
                return view('company.action', ['id' => $id, 'name' => 'admin']);
            })

        ];
    }
}
