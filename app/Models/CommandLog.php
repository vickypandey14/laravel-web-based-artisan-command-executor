<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommandLog extends Model
{
    protected $table = 'command_logs';

    protected $fillable = [
        'command', 
        'output'
    ];
}
