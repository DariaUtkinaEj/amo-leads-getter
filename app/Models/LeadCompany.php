<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCompany extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_company';
    protected $fillable = [
        'lead_id',
        'company_id',
    ];
}

