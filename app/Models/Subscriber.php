<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'state'];

    public static array $default_states = ['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed'];
}