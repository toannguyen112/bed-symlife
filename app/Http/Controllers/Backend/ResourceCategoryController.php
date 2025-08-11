<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Models\Post\PostCategory;
use App\Traits\HasCrudActions;

class ResourceCategoryController extends Controller
{
    use HasCrudActions;
    public $model = PostCategory::class;

    private function getTable()
    {
        return 'ResouceCategories';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'RESOURCE')
            ->orderBy('id', 'DESC');
    }
}
