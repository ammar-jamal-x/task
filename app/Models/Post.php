<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table ="posts";
    protected $fillable = [
        'user_id','category_id',
        'title','body',
        'visible','image',
        'sub_category_id'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'Post_tag');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function deleted_posts()
    {
        return $this->belongsTo(Delete_posts::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'sub_category_id');
    }
}
