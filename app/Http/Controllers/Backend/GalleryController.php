<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class GalleryController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    public $with = [
        'form' => ['relatedPosts']
    ];

    private function getTable()
    {
        return 'Galleries';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'Gallery')
            ->orderBy('id', 'DESC');
    }
}
