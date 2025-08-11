<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use JamstackVietnam\Core\Traits\ApiResponse;
use App\Models\Product\Product;
use App\Models\Post\Post;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ApiResponse;

    public function getResource($resource_id): JsonResponse
    {
        $resource = Post::query()
            ->active()
            ->where('type', Post::TYPE_RESOURCE)
            ->where('id', $resource_id)
            ->firstOrFail();

        return $this->success($resource->transformDetails());
    }

    public function getCourse($course_id): JsonResponse
    {
        $course = Post::query()
            ->active()
            ->where('type', Post::TYPE_COURSE)
            ->where('id', $course_id)
            ->firstOrFail();

        return $this->success($course->transformDetails());
    }
}
