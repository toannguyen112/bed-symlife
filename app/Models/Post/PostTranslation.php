<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Traits\Sluggable;

class PostTranslation extends BaseModel
{
    use HasFactory, Sluggable;

    public $timestamps = false;
    public $slugAttribute = 'title';

    public $fillable = [
        'slug',
        'locale',
        'status_locale',
        'title',
        'author',
        'description',
        'content',
        'sliders',
        'take_note',

        'number_of_course',
        'timetable',

        'schedule',
        'groups',
        'course_for',
        'knowledge_content',
        'course_target',

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
        'sliders' => 'array',
        'schedule' => 'array',
        'groups' => 'array',
        'course_for' => 'array',
        'knowledge_content' => 'array',
        'course_target' => 'array',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
