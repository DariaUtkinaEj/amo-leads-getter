<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadContact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_contact';
    protected $fillable = [
        'id',
        'lead_id',
        'is_main',
        'name',
        'first_name',
        'last_name',
        'responsible_user_id',
        'group_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'closest_task_at',
        'account_id',
        'is_unsorted',
    ];
}

