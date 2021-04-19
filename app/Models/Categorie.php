<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','name_ar',
        'parent_to'];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function subCategorie()
    {
        return $this->hasOne(Categorie::class,'parent_to','id');
    }
}
