<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Traits\Sluggable;

class ProductTranslation extends BaseModel
{
    use HasFactory, Sluggable;

    public $timestamps = false;
    public $slugAttribute = 'title';

    public $fillable = [
        'slug',
        'locale',
        'title',
        'description',

        'specification',
        "info_other",
        'summary',
        'content',
        'ingredient',
        'promotion',

        'seo_meta_title',
        'seo_slug',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_meta_robots',
        'seo_canonical',
        'seo_image',
        'seo_schemas',
    ];

    protected $casts = [
        'questions' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
