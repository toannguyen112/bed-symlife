<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\AgencyController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ApplyController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ResourceController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ContactCheckoutCourseController;
use App\Http\Controllers\Backend\ContactCheckoutResourceController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\HistoryController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\CourseCategoryController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\ResourceCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\PolicyController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\FeedbackController;
use App\Http\Controllers\Backend\IntroduceController;
use App\Http\Controllers\Backend\LearningEnvironmentController;
use App\Http\Controllers\Backend\PrizeController;

Route::localized(function () {
    Route::middleware(['auth:admin'])->name('admin.')->group(function () {
        Route::module(PostController::class);
        Route::module(ProductController::class);
        Route::module(BrandController::class);
        Route::module(PostCategoryController::class);
        Route::module(TagController::class);
        Route::module(AgencyController::class);
        Route::module(ContactController::class);
        Route::module(ContactCheckoutResourceController::class);
        Route::module(ContactCheckoutCourseController::class);
        Route::module(SliderController::class);
        Route::module(HistoryController::class);
        Route::module(CourseController::class);
        Route::module(MemberController::class);
        Route::module(FeedbackController::class);
        Route::module(ResourceController::class);
        Route::module(ResourceCategoryController::class);
        Route::module(CourseCategoryController::class);
        Route::module(GalleryController::class);
        Route::module(ServiceController::class);
        Route::module(ApplyController::class);
        Route::module(ProductCategoryController::class);
        Route::module(PolicyController::class);

        Route::module(FaqController::class);
        Route::module(LearningEnvironmentController::class);
        Route::module(PrizeController::class);
        Route::module(IntroduceController::class);
    });
});
