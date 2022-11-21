<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadLossReason extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_loss_reason';
    protected $fillable = [
        'id',
        'lead_id',
        'name'
    ];
}

