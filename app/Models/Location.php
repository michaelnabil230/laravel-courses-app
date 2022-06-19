<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use SoftDeletes;use Auditable;use HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The translatable attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatable = [
        'name',
    ];
}
