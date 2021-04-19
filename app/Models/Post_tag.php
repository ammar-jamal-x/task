<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id','tag_id',];

    protected $table = 'post_tag';
    public function Post()
    {
        return $this->hasMany(Post::class);
    }
    public function Tag()
    {
        return $this->hasMany(Tag::class);
    }
}
