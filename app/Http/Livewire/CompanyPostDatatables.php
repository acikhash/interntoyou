<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CompanyPostDatatables extends LivewireDatatable
{
    public $model = Post::class;
    public function builder()
    {
        return Post::query()
            ->leftJoin('companies', 'companies.id', 'posts.company_id')
            ->leftJoin('job_fields', 'job_fields.id', 'posts.job_field_id')
            ->where('posts.company_id', '=', Auth::user()->company_id)
            ->groupBy('posts.id');
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
            Column::name('job_title')
                ->label('Job Title')->filterable()->searchable(),
            Column::name('companies.name')
                ->label('Company')->searchable()->filterable(),
            Column::name('job_fields.description')
                ->label('Job Fields')->searchable()->filterable(),
            Column::raw("if(posts.status = 1, 'Open' ,'Close') AS status")->label('Status')->filterable(),
            DateColumn::name('created_at')
                ->label('Creation Date'),
            Column::callback(['id'], function ($id) {
                return view('post.action', ['id' => $id, 'name' => 'admin']);
            })

        ];
    }
}
