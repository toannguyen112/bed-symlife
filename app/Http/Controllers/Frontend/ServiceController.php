<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Service;

class ServiceController extends Controller
{

    public function index()
    {
        try {
            $services = Service::query()
                ->active()
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'services' => $services
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Services/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $post = Service::query()
                ->active()
                ->whereSlug($slug)
                ->firstOrFail();

            $data = [
                'post' => $post->transformDetails(),
                'seo' => $post->transformSeo()
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Show', $data)
                ->withViewData([
                    'seo' => $data['seo'],
                ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
