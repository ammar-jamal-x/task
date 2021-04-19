<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','name_ar',
        'parent_to'];
    public function Post()
    {
        return $this->hasMany(Post::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class,'parent_to');
    }
    public function childCategory()
    {
        return $this->hasMany(Category::class,'parent_to')->with('categories');
    }
}
