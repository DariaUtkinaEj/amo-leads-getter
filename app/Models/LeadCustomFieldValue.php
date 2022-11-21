<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCustomFieldValue extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_custom_field_value';
    protected $fillable = [
        'id',
        'lead_custom_field_id',
        'value'
    ];
}

