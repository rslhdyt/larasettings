<?php

namespace Rslhdyt\LaraSettings\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'label',
        'groups',
        'key',
        'value',
    ];
}
