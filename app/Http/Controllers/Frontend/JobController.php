<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use JamstackVietnam\Job\Models\Job;
use App\Models\Post;
use JamstackVietnam\Slider\Models\Slider;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->active()
            ->sortByPosition()
            ->get()
            ->map(fn ($item) => $item->transform());

        $posts = Post::query()
            ->activeLocale()
            ->activeCategories()
            ->orderBy('is_featured', 'desc')
            ->orderByPosition()
            ->orderBy('id', 'desc')
            ->take(8)
            ->get()
            ->map(fn ($item) => $item->transform());

        $data = [
            'jobs' => $jobs,
            'posts' => $posts,
            'sliders' => Slider::getByPosition('JOB_SLIDER'),
        ];

        if (request()->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('Jobs/Index', $data);
    }

    public function show($slug)
    {
        $job = Job::query()
            ->active()
            ->whereSlug($slug)
            ->firstOrFail();

        $job->increment('view_count');

        $data = [
            'job' => $job->transformDetails(),
            'seo' => $job->transformSeo()
        ];

        if (request()->wantsJson()) {
            return response()->json($data);
        }

        return Inertia::render('Jobs/Show', $data)
            ->withViewData(['seo' => $data['seo']]);
    }

    public function relatedJobs($jobId)
    {
        $job = Job::query()
            ->setEagerLoads([])
            ->with('relatedJobs')
            ->find($jobId);

        $items = $job->relatedJobs()
            ->active()
            ->get()
            ->map(fn ($item) => $item->transform());

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'OK',
        ], 200);
    }
}
