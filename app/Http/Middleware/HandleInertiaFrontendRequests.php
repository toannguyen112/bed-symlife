<?php

namespace App\Http\Middleware;

use App\Models\Post\Post;
use Inertia\Middleware;
use Illuminate\Http\Request;
use App\Models\Policy\Policy;
use JamstackVietnam\MetaPage\Models\MetaPage;
use JamstackVietnam\Slider\Models\Slider;

use Illuminate\Contracts\View\Factory as ViewFactory;

class HandleInertiaFrontendRequests extends Middleware
{
    protected $rootView = 'frontend::app';
    protected const FEATURED_POSITION_POST_CATEGORIES = 1;
    protected const MENU_POSITION_POST_CATEGORIES = 2;

    protected $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function share(Request $request)
    {
        $relativeUrl = str_replace(env('APP_URL'), '',  url()->current());
        $metaPage = MetaPage::where('url', $relativeUrl ?: '/')->first();

        $footerCourses = Post::query()
            ->active()
            ->whereMenuFooter()
            ->get()
            ->map(fn($item) => $item->transform());

        $learning_env = Post::query()
            ->active()
            ->whereLearningEnv()
            ->get()
            ->map(fn($item) => $item->transform());

        $policies = Policy::query()
            ->active()
            ->sortByPosition()
            ->get()
            ->map(fn($item) => $item->transform());

        $members = Post::query()
            ->active()
            ->where('type', Post::TYPE_MEMBER)
            ->get()
            ->map(fn($item) => $item->transformMember());

        $faqs = Post::query()
            ->active()
            ->where('type', Post::TYPE_FAQ)
            ->get()
            ->map(fn($item) => $item->transformFaqs());

        $post_post = Post::query()
            ->active()
            ->where('type_post', Post::KINHNGHIEMSUDUNG)
            ->get()
            ->map(fn($item) => $item->transform());

        $post_about = Post::query()
            ->active()
            ->where('type_post', Post::GIOITHIEU)
            ->get()
            ->map(fn($item) => $item->transform());

        $post_service = Post::query()
            ->where('type_post', Post::DICH_VU_KHAC)
            ->get()
            ->map(fn($item) => $item->transform());

        $post_maylanh = Post::query()
            ->active()
            ->where('type_post', Post::MAYLANH)
            ->get()
            ->map(fn($item) => $item->transform());

        $post_dien_lanh_cong_nghiep = Post::query()
            ->active()
            ->where('type_post', Post::DIEN_LANH_CONG_NGHIEP)
            ->get()
            ->map(fn($item) => $item->transform());

        $banner_home = Slider::getByPosition('HOME_SLIDER');
        $banner_about_1 = Slider::getByPosition('BANNER_ABOUT_SECTION_1');
        $banner_about_2 = Slider::getByPosition('BANNER_ABOUT_SECTION_2');
        $banner_gallery = Slider::getByPosition('BANNER_GALLERY');
        $banner_course = Slider::getByPosition('BANNER_COURSE');
        $banner_resource = Slider::getByPosition('BANNER_RESOURCE');
        $banner_service = Slider::getByPosition('BANNER_SERVICE');

        $global = cache_response(
            'global_settings',
            function () {
                return settings()
                    ->group('general')
                    ->all();
            },
            'settings',
        );

        if ($request->wantsJson()) {
            return parent::share($request);
        }

        $share = array_merge(parent::share($request), [
            'global' => $global,
            'locale' => [
                'current' => current_locale(),
                'default' => config('app.locale'),
                'list' => config('app.locales'),
            ],
            'route' => [
                'url' => $request->url(),
                'path' => $request->path(),
                'name' => $request->route()->getName(),
                'query' => $request->query(),
            ],

            'data' => [
                'post_about' => $post_about,
                'post_service' => $post_service,
                'post_maylanh' => $post_maylanh,
                'post_dien_lanh_cong_nghiep' => $post_dien_lanh_cong_nghiep,
                'post_post' => $post_post,

                'members' => $members,
                'policies' => $policies,
                'banner' => [
                    'banner_home' => $banner_home,
                    'banner_about_1' => $banner_about_1,
                    'banner_about_2' => $banner_about_2,
                    'banner_gallery' => $banner_gallery,
                    'banner_course' => $banner_course,
                    'banner_resource' => $banner_resource,
                    'banner_service' => $banner_service,
                ]
            ]
        ]);

        if ($metaPage) {
            $share['seo'] = $metaPage;
            $this->viewFactory->share('seo', $metaPage);
        }

        return $share;
    }
}
