<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GHelp extends Model
{
    use HasFactory;

    protected $table = 'g_helps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'amount',
        'type',
        'currency',
    ];

}
