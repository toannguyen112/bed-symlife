<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class MemberController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    public $with = [
        'form' => ['relatedPosts']
    ];

    private function getTable()
    {
        return 'Members';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'MEMBER')
            ->orderBy('id', 'DESC');
    }
}
