<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name','name_ar'];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'Post_tag');
    }
}
