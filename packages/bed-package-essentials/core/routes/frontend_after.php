<?php

use Illuminate\Support\Facades\Route;

Route::get('error', fn() => inertia('Error'))->name('error');
Route::localized(function () {
    Route::get('/{path}', fn() => abort(404))->where('path', '^(?!admin|totem).*$');
});
