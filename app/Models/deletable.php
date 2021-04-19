<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deletable extends Model
{
    use HasFactory;
    protected $table ="deletable";
    protected $fillable = [
        'deletable_id','deletable_type',
        'message'];
}
