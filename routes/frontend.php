<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\AgencyController;
use App\Http\Controllers\Frontend\HistoryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\PolicyController;
use App\Http\Controllers\Frontend\ResourceController;
use Inertia\Inertia;


Route::get('sitemap.xml', [SitemapController::class, 'index']);

Route::middleware(['meta_seo'])->group(function () {
    Route::localized(function () {
        Route::get(Lang::uri('/'), [HomeController::class, 'index'])->name('home');
        Route::get(Lang::uri('search'), [HomeController::class, 'search'])->name('search');
        Route::get(Lang::uri('/contact'), [AgencyController::class, 'index'])->name('contact');


        Route::controller(HistoryController::class)->group(function () {
            Route::get(Lang::uri('about-us'), 'index')->name('histories.index');
            Route::get(Lang::uri('histories') . '/{slug}', 'show')->name('histories.show');
        });

        Route::controller(ServiceController::class)->group(function () {
            Route::get(Lang::uri('services'), 'index')->name('services.index');
            Route::get(Lang::uri('services') . '/{slug}', 'show')->name('services.show');
        });

        Route::controller(PostController::class)->group(function () {
            Route::get(Lang::uri('posts'), 'index')->name('posts');
            Route::get(Lang::uri('posts') . '/{slug}', 'show')->name('posts.show');

            Route::get('/nhat-ky-thi-cong', 'memories')->name('members.index');
            Route::get('/nhat-ky-thi-cong' . '/{slugMember}', 'showMember')->name('members.show');
        });

        Route::controller(ProductController::class)->group(function () {
            Route::get(Lang::uri('products'), 'index')->name('products.index');
            Route::get(Lang::uri('products') . '/{slug}', 'show')->name('products.show');

            Route::get(Lang::uri('gallery'), 'galleries')->name('galleries.index');
        });

        Route::controller(CourseController::class)->group(function () {
            Route::get(Lang::uri('courses'), 'index')->name('courses.index');
            Route::get(Lang::uri('courses') . '/{slug}', 'show')->name('courses.show');
        });

        Route::controller(ResourceController::class)->group(function () {
            Route::get(Lang::uri('resources'), 'index')->name('resources.index');
        });

        Route::controller(OrderController::class)->group(function () {
            Route::get('checkout/courses', function () {
                return Inertia::render('Checkout/Checkout');
            })->name('checkout.course.index');

            Route::get('checkout/resources', function () {
                return Inertia::render('Checkout/CheckoutResource');
            })->name('checkout.resources.index');;
        });

        Route::get('ve-chung-toi', function () {
            return Inertia::render('About');
        });

        Route::controller(JobController::class)->group(function () {
            Route::get(Lang::uri('jobs'), 'index')->name('jobs.index');
            Route::get(Lang::uri('jobs') . '/{slug}', 'show')->name('jobs.show');
            Route::get(Lang::uri('related-jobs/{id}'), 'relatedJobs')->name('jobs.related_jobs');
        });

        Route::post(Lang::uri('contacts'), [ContactController::class, 'store'])->name('contact.store');

        Route::controller(PolicyController::class)->group(function () {
            Route::get(Lang::uri('policies'), 'index')->name('policies.index');
            Route::get(Lang::uri('policies') . '/{slug}', 'show')->name('policies.show');
        });
    });
});
Route::dynamicRedirect();
