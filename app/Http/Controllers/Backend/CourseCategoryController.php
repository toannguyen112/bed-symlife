<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Models\Post\PostCategory;
use App\Traits\HasCrudActions;

class CourseCategoryController extends Controller
{
    use HasCrudActions;
    public $model = PostCategory::class;

    private function getTable()
    {
        return 'CourseCategories';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'COURSE')
            ->orderBy('id', 'DESC');
    }
}
