<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCustomField extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_custom_field';
    protected $fillable = [
        'id',
        'lead_id',
        'field_id',
        'field_code',
        'field_name',
        'field_type',
    ];
}

