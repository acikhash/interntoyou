<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserDatatables extends LivewireDatatable
{
    public $model = User::class;
    public function builder()
    {
        return User::query()
            ->leftJoin('companies', 'companies.id', 'users.company_id')
            ->groupBy('users.id');
    }
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
                ->label('Name')->filterable(),
            Column::name('email'),
            Column::raw("if(users.role = 1, 'Admin' ,'Company Manager') AS roles")->label('Role')->filterable(),
            Column::name('companies.name')
                ->label('Company')->searchable()->filterable(),
            DateColumn::name('created_at')
                ->label('Creation Date'),
            Column::callback(['id'], function ($id) {
                return view('user.show', ['id' => $id, 'name' => 'admin']);
            })

        ];
    }
}
