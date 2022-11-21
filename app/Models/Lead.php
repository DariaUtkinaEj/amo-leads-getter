<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead';
    protected $fillable = [
        'id',
        'name',
        'price',
        'responsible_user_id',
        'group_id',
        'status_id',
        'pipeline_id',
        'loss_reason_id',
        'source_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'closest_task_at',
        'is_deleted',
        'score',
        'account_id',
        'is_price_modified_by_robot'
    ];
}

