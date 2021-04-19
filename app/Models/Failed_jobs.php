<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Failed_jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'connection','queue',
        'payload','exception','updated_at'];

}
