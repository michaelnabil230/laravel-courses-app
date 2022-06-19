<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trainer extends Model
{
    use SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'note'
    ];

    /**
     * Fields of searchable.
     *
     * @return array<int, string>
     */
    public static $searchable = [
        'name',
        'phone',
        'note'
    ];
}
