<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class ResourceController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    public $with = [
        'form' => ['relatedPosts']
    ];

    private function getTable()
    {
        return 'Resources';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'RESOURCE')
            ->orderBy('id', 'DESC');
    }
}
