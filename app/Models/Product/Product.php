<?php

namespace App\Models\Product;

use App\Models\Brand\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;
use App\Traits\Searchable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Option;
use App\Models\Post\Post;

class Product extends BaseModel
{
    use HasFactory, Translatable, SoftDeletes, Searchable;

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Kích hoạt',
        self::STATUS_INACTIVE => 'Tắt',
    ];

    public $with = [
        'translations',
        'categories',
        'brand',
        'courses'
    ];

    public $fillable = [
        'brand_id',
        'status',
        'is_featured',
        'banner',
        'is_new',
        'is_stock',
        'is_stock',
        'view_count',
        'images',
        'image',
        'video_url',
        'sku',

        'inject_head',
        'inject_body_start',
        'inject_body_end',

        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public $translatedAttributes = [
        'slug',
        'locale',
        'title',
        'content',
        'description',

        'seo_meta_title',
        'seo_slug',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_meta_robots',
        'seo_canonical',
        'seo_image',
        'seo_schemas',
    ];

    protected $searchable = [
        'columns' => [
            'product_translations.title' => 10,
            'product_translations.slug' => 10,
            'product_translations.id' => 1,
            'products.sku' => 1
        ],
        'joins' => [
            'product_translations' => ['product_translations.product_id', 'products.id'],
        ]
    ];

    public $appends = ['url'];

    protected $casts = [
        'images' => 'array',
        'image' => 'array',
        'banner' => 'array',
    ];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'seo_slug' => 'nullable|unique:product_translations,slug|max:255',
            'seo_slug' => 'nullable|unique:product_translations,seo_slug|max:255',
        ];
    }

    protected static function booted()
    {
        static::saving(function (self $model) {
            if (strpos(request()->getRequestUri(), '/products/store') == false) return;

            $model->view_count = request()->input('view_count') ?? 0;
            $model->checkStatus($model);
        });

        static::saved(function (self $model) {
            if (strpos(request()->getRequestUri(), '/products/store') == false) return;
            $model->saveCourses($model);
        });
    }

    private function checkStatus($model)
    {
        $categories = array_column(request()->input('categories', []), 'id');
        $hasCategories = ProductCategory::active()->whereIn('id', $categories)->exists();
    }

    public function saveRelatedProducts($model)
    {
        $relatedProducts = array_column(request()->input('related_products', []), 'id');
        $model->relatedProducts()->sync($relatedProducts, 'id');
    }

    public function savePosts($model)
    {
        $posts = array_column(request()->input('posts', []), 'id');
        $model->posts()->sync($posts, 'id');
    }

    public function saveCourses($model)
    {
        $posts = array_column(request()->input('posts', []), 'id');
        $model->courses()->sync($posts, 'id');
    }

    public function saveTags($model)
    {
        $tags = array_column(request()->input('tags', []), 'id');
        $model->tags()->sync($tags, 'id');
    }

    public function saveCategories($model)
    {
        $categories = array_column(request()->input('categories', []), 'id');
        $model->categories()->sync($categories, 'id');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(
            self::class,
            'related_products',
            'product_id',
            'related_product_id'
        )
            ->withPivot('id')
            ->orderBy('related_products.id', 'ASC');
    }

    public function scopeActiveLocale($query)
    {
        $locale = current_locale();
        $query =  $query->whereHas('translations', function ($q) use ($locale) {
            $q->where('status_locale', Product::STATUS_ACTIVE)->where('locale', '=', $locale);
        });
        return $query;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            ProductCategory::class,
            'product_ref_categories',
            'product_id',
            'product_category_id'
        );
    }

    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'product_ref_posts',
            'product_id',
            'post_id'
        );
    }

    public function courses()
    {
        return $this->belongsToMany(
            Post::class,
            'product_ref_posts',
            'product_id',
            'post_id'
        );
    }

    public static function getRootCategory()
    {
        if (request()->has('categoryId')) {
            return static::active()
                ->whereHas('categories', function ($query) {
                    $query->where('id', request()->input('categoryId'));
                })
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => (string) $item['id'],
                        'label' => $item['title']
                    ];
                });
        }

        return static::active()
            ->get()
            ->map(function ($item) {
                return [
                    'id' => (string) $item['id'],
                    'label' => $item['title']
                ];
            });
    }

    public function getProducts()
    {
        $data = Product::where('products.status', self::STATUS_ACTIVE)
            ->get();

        return $data;
    }

    public function getCategoryAttribute()
    {
        return $this->courses
            ->values()
            ->first()
            ?->transform();
    }

    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id');
    }

    public function variantOptions()
    {
        return $this->options()->where('options.parent_id', '!=', 0);
    }

    public function options()
    {
        return $this->belongsToMany(
            Option::class,
            'product_variant_ref_options',
            'product_id',
            'option_id',
        )
            ->withPivot('position', 'is_required', 'product_variant_id')
            ->orderBy('is_required', 'DESC')
            ->orderBy('position', 'DESC');
    }

    public function productOptions()
    {
        return $this->options()->where('options.parent_id', 0);
    }

    public function childrenOptions()
    {
        return $this->options()->where('options.parent_id', '!=', 0);
    }

    public function getListOptionCoverAttribute()
    {
        $listOptions = Option::transformNested($this->productOptions, $this->childrenOptions);

        $listOptions = $listOptions->map(function ($item) {
            $option = $this->productOptions
                ->where('id', $item['id'])
                ->first();

            $item['id'] = strval($item['id']);
            $item['is_required'] = $option['pivot']['is_required'] ?? false;
            $item['position'] = $option['pivot']['position'] ?? 0;
            $item['is_show_detail'] = $option['is_show_detail'] ?? 0;
            $item['nodes'] = collect($item['nodes'])->map(function ($value) {
                $value['id'] = strval($value['id']);
                return $value;
            });

            return $item;
        });

        return $listOptions;
    }

    public function getListOptionAttribute()
    {
        $childrenOptions = $this->childrenOptions;
        return Option::transformNested($this->productOptions, $childrenOptions);
    }

    public static function lazySearch($data)
    {
        if ($data['keyword'] && !is_array($data['keyword'])) {
            $results = static::query()->search($data['keyword'])->limit(10)->get();
            if ($results->count() > 0) {
                return $results->merge(static::query()->whereNotIn('id', $results->pluck('id'))->get());
            }
        }

        return static::query()->get();
    }

    public function getImageDefaultAttribute()
    {
        $variant = $this->variants->where('is_default')->first();

        if (!empty($variant->id) && count($variant->images) > 0) {
            return [
                'url' => static_url($variant->images[0]['path']) ?? null,
                'path' => $variant->images[0]['path'] ?? null,
                'alt' => $variant->images[0]['alt'] ?? $this->title,
            ];
        }

        return $this->images
            ? [
                'url' => static_url($this->images[0]['path']) ?? null,
                'path' => $this->images[0]['path'] ?? null,
                'alt' => $this->images[0]['alt'] ?? $this->title,
            ]
            : null;
    }

    public function getUrlAttribute(): array
    {
        $urls = [];
        if ($this->is_active) {
            foreach ($this->translations as $translation) {
                $slug = $translation->seo_slug ?? $translation->slug;

                $urls[strtoupper($translation->locale)] = route("$translation->locale.products.show", [
                    'slug' => $slug,
                ]);
            }
        }
        return $urls;
    }

    public function getIsActiveAttribute()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function getBreadcrumbsAttribute()
    {
        $category = $this->categories
            ->where('status', ProductCategory::STATUS_ACTIVE)
            ->sortBy([['parent_id', 'desc']])
            ->values()
            ->first();

        return ProductCategory::transformAsBreadcrumb($category);
    }

    public function getImageDetail($image)
    {
        return [
            'url' => isset($image['path']) ? static_url($image['path']) : null,
            'alt' => $image['alt'] ?? $this->title,
        ];
    }

    public function transform()
    {
        $categories = $this->courses
            ->where('status', self::STATUS_ACTIVE)
            ->values()
            ->map(fn($item) => $item->transform());

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'categories' => $categories,
            'image' => $this->image,
            'sku' => $this->sku,
            'description' => $this->description,
            'is_new' => $this->is_new,
            'is_stock' => $this->is_stock,
            'brand' => $this->brand?->transform(),
            'url' => $this->url,
            'image' => $this->getImageDetail($this->image),
        ];

        return $data;
    }

    public function transformCategory($conditions = ['options' => []])
    {
        $options = $this->optionDetails($conditions['options']);

        return array_merge($options, [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category,
            'slug' => $this->seo_slug ?? $this->slug,
            'sku' => $this->sku
        ]);
    }

    public function optionDetails($list = [])
    {
        $options = [];

        foreach ($list as $optionTitle) {
            $option = $this->list_option->filter(function ($item) use ($optionTitle) {
                return  $item['title'] === $optionTitle;
            })->first();

            if ($option) {
                $options[$optionTitle] = $option['nodes']->pluck('title')->join(', ');
            } else {
                $options[$optionTitle] = null;
            }
        }
        return $options;
    }

    public function transformDetails()
    {

        $images = $variant['images'] ?? collect($this->images)
            ->map(function ($item) {
                return [
                    'url' => static_url($item['path']) ?? null,
                    'alt' => $item['alt'] ?? $this->title
                ];
            });

        return  [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'banner' => $this->getImageDetail($this->banner),
            'content' => transform_richtext($this->content),
            'slug' => $this->seo_slug ?? $this->slug,
            'images' => $images,
        ];
    }

    public function optionsMappingThumbnail($options, $primaryOptionValues)
    {
        $values = $primaryOptionValues->pluck('thumbnail_url', 'primary_option.id');

        return $options->map(function ($option) use ($values) {
            $option['show_name'] = $option['id'] !== 1;
            $option['nodes'] = $option['nodes']->map(function ($node) use ($values) {
                if (isset($values[$node['id']])) {
                    $node['image_url'] = $values[$node['id']];
                }
                return $node;
            });
            return $option;
        });
    }

    public function transformGeneral()
    {
        $data = [
            'id' => $this->id,

            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'quantity_free_shipping' => $this->quantity_free_shipping,

            'category' => $this->category,
            'sku' => $this->sku,
            'rate_score' => round($this->rate_score, 1),
            'ratings_count' => $this->ratings_count,
            'variant' => $variant ?? $this->default_variant,
            'description' => $this->description,
            'brand' => $this->brand?->transform(),
            'origin' => $this->origin?->transform(),

            'image' => $this->image_default,

            'url' => $this->url,
        ];

        return $data;
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('products.status', self::STATUS_ACTIVE);
    }

    public function scopeIsFeatured(Builder $query)
    {
        return $query->where('is_featured', 1);
    }

    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        $query->when($filters['products'] ?? false, function (Builder $query, $products) {
            $ids = explode(',', $products);
            $query->whereIn('id', $ids);
        });

        $query->when($filters['categories'] ?? false, function (Builder $query, $categories) {
            $ids = explode(',', $categories);

            $categories = ProductCategory::query()
                ->with('children')
                ->whereIn('id', $ids)
                ->get();

            foreach ($categories as $category) {
                $categoryIds[] = $category->id;
                $categoryIds = array_merge($categoryIds, $category->children->pluck('id')->toArray());
            }

            $query->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('id', $categoryIds);
            });
        });

        $query->when($filters['courses'] ?? false, function (Builder $query, $categories) {
            $ids = explode(',', $categories);

            $query->whereHas('posts', function ($query) use ($ids) {
                $query->whereIn('id', $ids);
            });
        });

        if (empty($filters['sort'])) {
            $query->orderByPosition();
        }

        return $query;
    }

    public function transformSeo()
    {
        return transform_seo($this);
    }

    public function scopeOrderByPosition($query)
    {
        return $query->orderByRaw('ISNULL(position) OR position = 0, position ASC')
            ->orderByDesc('id');
    }

    public function scopeOrderByFeatured($query)
    {
        return $query->orderBy('is_featured', 'desc')
            ->orderByDesc('id');
    }

    public function getImageUrlAttribute()
    {
        return isset($this->images[0]['path']) ? static_url($this->images[0]['path']) : null;
    }

    public function related($condition = [])
    {
        $limit = empty($condition['limit']) ? 8 : $condition['limit'];
        $relatedProducts = $this->relatedProducts
            ->where('status', self::STATUS_ACTIVE)
            ->where('id', '<>', $this->id)
            ->where(function ($item) {
                return $item['categories']->where('status', self::STATUS_ACTIVE)->count() > 0;
            })
            ->values()
            ->take($limit);

        $relatedProductIds = [];

        if ($relatedProducts->count() > 0) {
            $relatedProductIds = $relatedProducts->pluck('id');
        }

        if (count($relatedProducts) < $limit) {
            $addProducts = self::query()
                ->active()
                ->when($this->category['id'] ?? false, function ($query) {
                    $query->whereHas('categories', function ($query) {
                        $query->where('id', $this->category['id']);
                    });
                })
                ->where('id', '<>', $this->id)
                ->whereNotIn('id', $relatedProductIds)
                ->take($limit - count($relatedProducts))
                ->get();

            if (count($addProducts) > 0) {
                $relatedProducts = $relatedProducts->concat($addProducts);
            }
        }

        return $relatedProducts->map(fn($item) => $item->transform());
    }

    public function getFlashSale($variant)
    {
        $getSaleDate = $this->getSaleDate();

        if ($this->sale_available && $variant['flash_sale_quantity'] > 0) {
            return [
                'is_sale' => true,
                'flash_sale_from' => $getSaleDate['flash_sale_from'],
                'flash_sale_to' => $getSaleDate['flash_sale_to'],
                'price' => $variant['sale_price'] ?? $variant['price'],
                'last_sale' => $getSaleDate['flash_sale_to'],
                'day_to_sale' => 1,
            ];
        } else {
            return [
                'is_sale' => false,
                'flash_sale_to' => $this->flash_sale_from,
                'flash_sale_from' => $this->flash_sale_to,
            ];
        }
    }

    public function scopeSearchSlug($query, $slug)
    {
        $queryRaw = [];
        $words = collect(explode('-', $slug));

        if ($words->count() === 1 || $words->count() > 4) {
            $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) LIKE '%-$slug-%' then 50 else 0 end)";
            $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) LIKE '$slug-%' then 50 else 0 end)";
            $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) LIKE '%-$slug' then 50 else 0 end)";
            $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) LIKE '%$slug%' then 10 else 0 end)";
        } else {
            $rowWords = $this->combinations($words, count($words));

            foreach ($rowWords as $words) {
                $subQueryRaw1 = '';
                $subQueryRaw2 = '';
                $subQueryRaw3 = '';
                foreach ($words as $index => $word) {
                    if ($index == 0) {
                        $subQueryRaw1 .= "LIKE '%-$word-%'";
                        $subQueryRaw2 .= "LIKE '$word-%'";
                        $subQueryRaw3 .= "LIKE '%-$word-%'";
                    } else if ($index == count($words) - 1) {
                        $subQueryRaw1 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word-%'";
                        $subQueryRaw2 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word-%'";
                        $subQueryRaw3 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word'";
                    } else {
                        $subQueryRaw1 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word-%'";
                        $subQueryRaw2 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word-%'";
                        $subQueryRaw3 .= " AND LOWER(`product_translations`.`slug`) LIKE '%-$word-%'";
                    }
                }
                $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) " . $subQueryRaw1 . " then " . count($words) * 10 . " else 0 end)";
                $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) " . $subQueryRaw2 . " then " . count($words) * 10 . " else 0 end)";
                $queryRaw[] = "(case when LOWER(`product_translations`.`slug`) " . $subQueryRaw3 . " then " . count($words) * 10 . " else 0 end)";
            }
        }

        $query
            ->join('product_translations', function ($join) {
                $join->on('products.id', '=', 'product_translations.product_id');
            })
            ->select('products.id', 'products.images')
            ->selectRaw(
                "max(
                        " . join(' + ', $queryRaw) . "
                    ) as priority",
            )
            ->having('priority', '>', 0)
            ->orderBy('priority', 'DESC');

        return $query->groupBy('id');
    }

    public function combinations($arr, $count)
    {
        $combinations = array();
        $combination = array_fill(0, $count, 0);

        while (1) {
            $temp = array();
            for ($i = 0; $i < $count; ++$i)
                $temp[] = $arr[$combination[$i]];
            $combinations[] = $temp;

            $i = $count - 1;
            while ($i >= 0 && $combination[$i] == count($arr) - 1)
                --$i;

            if ($i < 0)
                break;

            ++$combination[$i];

            for ($j = $i + 1; $j < $count; ++$j)
                $combination[$j] = $combination[$i];
        }

        $combinations = collect($combinations)->map(function ($item) {
            return array_unique($item);
        })->filter(function ($item) {
            return count($item) > 1;
        })
            ->values()
            ->toArray();

        return $combinations;
    }
}
