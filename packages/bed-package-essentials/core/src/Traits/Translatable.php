<?php

namespace JamstackVietnam\Core\Traits;

use Astrotomic\Translatable\Translatable as AstrotomicTranslatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

trait Translatable
{
    use AstrotomicTranslatable;

    public function getDefaultLocale(): ?string
    {
        return current_locale();
    }

    public function getTranslationStatusesAttribute()
    {
        $translations = [];
        foreach (config('app.locales') as $locale) {
            $translations[$locale] = $this->hasTranslation($locale);
        }
        return $translations;
    }

    public function scopeActive($query)
    {
        $query = $query->where('status', 'ACTIVE')
            ->whereLocaleActive();

        return $query;
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->whereHas('translations', function ($query) use ($slug) {
            $query->where('seo_slug', $slug)->orWhere('slug', $slug);
        });
    }

    public function scopeWhereLocaleActive($query)
    {
        if (!empty(request()->route()->getName())) {
            $locale = current_locale();
            $default_locale = config('app.locale');

            $query = $query->whereHas('translations', function (Builder $q) use ($locale, $default_locale) {
                $q->where('locale', '=', $locale);

                if (config('app.use_default_locale', true)) {
                    $q->orWhere('locale', '=', $default_locale);
                }
            });
        }

        return $query;
    }

    protected function useFallback(): bool
    {
        if (isset($this->useTranslationFallback) && is_bool($this->useTranslationFallback)) {
            return $this->useTranslationFallback;
        }

        if (str_contains(Route::current()->getName(), 'admin.')) {
            return (bool) config('translatable.use_fallback_backend', config('translatable.use_fallback', false));
        } else {
            return (bool) config('translatable.use_fallback_frontend', config('translatable.use_fallback', false));
        }
    }
}
