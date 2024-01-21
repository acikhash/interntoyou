<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class,  'company_id', 'id')->withDefault(['name' => 'internToYou.com']);
    }
    public function jobfield()
    {
        return $this->belongsTo(JobField::class,  'job_field_id', 'id')->withDefault(['name' => 'internToYou.com']);
    }
    public function getSearchPost($param)
    {
        $post = DB::table('posts')
            ->where('job_title', 'like', '%' . $param . '%')
            ->orWhere('description', 'like', '%' . $param . '%')
            ->paginate(6);
        return $post;
    }
}
