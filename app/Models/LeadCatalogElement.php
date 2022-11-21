<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadCatalogElement extends Model
{
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lead_catalog_element';
    protected $fillable = [
        'id',
        'lead_id',
        'metadata',
        'quantity',
        'catalog_id',
        'price_id',
    ];
}

