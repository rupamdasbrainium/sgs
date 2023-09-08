<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use SoftDeletes;
    protected $fillable = ['question', 'slug', 'answer'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $table = 'faqs';
}
