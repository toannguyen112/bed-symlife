<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use App\Traits\HasCrudActions;

class FeedbackController extends Controller
{
    use HasCrudActions;
    public $model = Post::class;

    private function beforeIndex($query)
    {
        return $query->where('type', 'FEEDBACK')
            ->orderBy('id', 'DESC');
    }

    private function getTable()
    {
        return 'Feedback';
    }
}
