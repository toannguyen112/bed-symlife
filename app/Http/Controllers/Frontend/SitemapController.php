<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use JamstackVietnam\Sitemap\Sitemap;
use App\Models\Service;

class SitemapController extends Controller
{
    public function index()
    {
        return Sitemap::create()
            ->addStaticRoutes()
            ->add(Post::active()->get()->pluck('url'))
            ->add(PostCategory::active()->get())
            ->add(Service::active()->get())
            ->render();
    }
}
