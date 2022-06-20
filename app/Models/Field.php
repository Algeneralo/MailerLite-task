<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['title', 'type', 'subscriber_id'];
    public static array $default_types = ['date', 'number', 'string', 'boolean'];
}