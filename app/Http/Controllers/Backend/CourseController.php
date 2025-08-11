<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class CourseController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    public $with = [
        'form' => ['relatedPosts', 'products']
    ];

    private function getTable()
    {
        return 'Courses';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'COURSE')
            ->orderBy('id', 'DESC');
    }
}
