<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table='requests';

    protected $fillable = [
        'id',
        'name',
        'email',
        'status',
        'message',
        'comment',
        'created_at',
        'updated_at',
    ];


}
