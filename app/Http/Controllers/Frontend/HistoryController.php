<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Post\Post;

class HistoryController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::query()
                ->active()
                ->orderByHomePosition()
                ->orderBy('id', 'desc')
                ->take(3)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'posts' => $posts,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('About', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
