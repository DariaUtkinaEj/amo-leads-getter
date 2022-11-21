<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company';
    protected $fillable = [
        'id',
        'name',
        'responsible_user_id',
        'group_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'closest_task_at',
        'account_id',
    ];
}

