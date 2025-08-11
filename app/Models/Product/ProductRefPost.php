<?php

namespace App\Models\Product;

use JamstackVietnam\Core\Models\BaseModel;

class ProductRefCategory extends BaseModel
{
    protected $table = 'product_ref_posts';
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = null;

    public $fillable = [
        'product_id',
        'post_id',
    ];
}
