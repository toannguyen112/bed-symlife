<?php

namespace App\Models\Post;

use App\Models\BaseModel;
use \Illuminate\Support\Facades\Route;
use App\Models\Post\PostCategory;
use App\Models\Product\Product;
use App\Traits\Searchable;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Post extends BaseModel
{
    use HasFactory, SoftDeletes, Searchable, Translatable;

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';

    public const TYPE_RESOURCE_FREE = 'FREE';
    public const TYPE_RESOURCE_PAY = 'PAY';

    public const TYPE_POST = 'POST';
    public const TYPE_FEEDBACK = 'FEEDBACK';
    public const TYPE_COURSE = 'COURSE';
    public const TYPE_RESOURCE = 'RESOURCE';
    public const TYPE_MEMBER = 'MEMBER';
    public const TYPE_FAQ = 'FAQ';
    public const TYPE_INTRODUCE = 'INTRODUCE';
    public const TYPE_LEARNING_ENV = 'LEARNING_ENV';
    public const TYPE_PRIZE = 'PRIZE';

    public const KINHNGHIEMSUDUNG = 'KINHNGHIEMSUDUNG';
    public const GIOITHIEU = 'GIOITHIEU';
    public const DICH_VU_KHAC = 'DICH_VU_KHAC';
    public const MAYLANH = 'MAYLANH';
    public const DIEN_LANH_CONG_NGHIEP = 'DIEN_LANH_CONG_NGHIEP';

    public const STATUS_LIST = [
        self::STATUS_ACTIVE => 'Kích hoạt',
        self::STATUS_INACTIVE => 'Tắt',
    ];

    public const TYPE_RESOURCE_LIST = [
        self::STATUS_ACTIVE => 'Free',
        self::STATUS_INACTIVE => 'Trả phí',
    ];

    public const TYPE_LIST = [
        self::TYPE_FEEDBACK => 'Feedback',
        self::TYPE_POST => 'Bài viết',
        self::TYPE_COURSE => 'Khóa học',
        self::TYPE_POST => 'Tài nguyen',
        self::TYPE_MEMBER => 'Đội ngũ',
        self::TYPE_FAQ => 'Faq',

        self::TYPE_LEARNING_ENV => 'Môi trường học',
        self::TYPE_PRIZE => 'Giải thưởng',
    ];

    public $with = ['translations', 'categories',];

    public $fillable = [
        'status',
        'published_at',
        'is_home',
        'type',
        'is_featured',
        'position',
        'download',
        'home_position',
        'type_post',
        'footer_position',
        'view_count',
        'image',
        'images',
        'banner',
        'banner_mobile',
        'show_table_of_contents',
        'link',
        'icon',
        'resource_type',
        'price',

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
        'author',
        'description',
        'content',
        'sliders',
        'take_note',

        'number_of_course',
        'timetable',

        'schedule',
        'groups',
        'course_for',
        'knowledge_content',
        'course_target',

        'seo_meta_title',
        'seo_slug',
        'seo_meta_description',
        'seo_meta_keywords',
        'seo_meta_robots',
        'seo_canonical',
        'seo_image',
        'seo_schemas',
    ];

    protected $casts = [
        'image' => 'array',
        'images' => 'array',
        'icon' => 'array',
        'banner' => 'array',
        'banner_mobile' => 'array',
    ];

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'position' => 'nullable|integer|min:0',
        ];
    }

    protected $searchable = [
        'columns' => [
            'post_translations.title' => 10,
            'post_translations.id' => 5,
            'post_translations.slug' => 5,
        ],
        'joins' => [
            'post_translations' => ['post_translations.post_id', 'posts.id'],
        ],
    ];

    protected $appends = ['url'];

    protected static function booted()
    {
        static::saving(function (self $model) {
            if (request()->route() === null) return;
            $model->published_at = request()->input('published_at') ?? now();
        });

        static::saved(function (self $model) {
            if (request()->route() === null) return;
            $model->saveRelatedPosts($model);
            $model->saveCategories($model);
            $model->saveProducts($model);
        });
    }

    public function saveCategories($model)
    {
        $categories = array_column(request()->input('categories', []), 'id');
        $model->categories()->sync($categories, 'id');
    }

    public function saveProducts($model)
    {
        $categories = array_column(request()->input('products', []), 'id');
        $model->products()->sync($categories, 'id');
    }

    public function saveRelatedPosts($model)
    {
        $relatedPosts = array_column(request()->input('related_posts', []), 'id');
        $model->relatedPosts()->sync($relatedPosts, 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(
            PostCategory::class,
            'post_ref_categories',
            'post_id',
            'post_category_id'
        );
    }

    public function relatedPosts()
    {
        return $this->belongsToMany(
            self::class,
            'related_posts',
            'post_id',
            'related_post_id'
        );
    }

    public function getPostRelatedIdsAttribute()
    {
        return $this->relatedPosts;
    }

    public function getUrlAttribute(): array
    {
        $urls = [];
        $default_locale = config('app.locale');

        if ($this->is_active) {
            if (Route::has($default_locale . ".posts.show")) {

                foreach ($this->translations as $translation) {
                    $urls[strtoupper($translation->locale)] = route("$translation->locale.posts.show", [
                        'slug' => $translation->seo_slug ?? $translation->slug,
                    ]);
                }
            }
        }

        return $urls;
    }

    public function getCategoryAttribute()
    {
        return $this->categories
            ->where('status', PostCategory::STATUS_ACTIVE)
            ->sortBy([['parent_id', 'desc']])
            ->values()
            ->first()?->transform();
    }

    public function getCourses()
    {
        return static::query()
            ->active()
            ->where('type', self::TYPE_COURSE)
            ->get();
    }

    public function getPosts()
    {
        return static::query()
            ->active()
            ->where('type', self::TYPE_POST)
            ->get();
    }

    public function getIsActiveAttribute()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function scopeActive($query)
    {
        return $query->whereLocaleActive()
            ->where('status', self::STATUS_ACTIVE);
    }

    public function scopeWhereMenuFooter($query)
    {
        return $query->where(function ($query) {
            $query
                ->whereNotNull('footer_position')
                ->where('footer_position', '>', 0);
        })
            ->orderBy('footer_position', 'asc')
            ->orderBy('id', 'desc');
    }

    public function scopeActiveCategories($query)
    {
        return $query->whereHas('categories', function ($query) {
            $query->active();
        });
    }

    public function scopeWhereResources($query)
    {
        return $query->where('type', self::TYPE_RESOURCE);
    }

    public function scopeWherePosts($query)
    {
        return $query->where('type', self::TYPE_POST);
    }

    public function scopeWhereCourses($query)
    {
        return $query->where('type', self::TYPE_COURSE);
    }

    public function scopeWhereFeedback($query)
    {
        return $query->where('type', self::TYPE_FEEDBACK);
    }

    public function scopeWhereMembers($query)
    {
        return $query->where('type', self::TYPE_MEMBER);
    }

    public function scopeWherePrizes($query)
    {
        return $query->where('type', self::TYPE_PRIZE);
    }

    public function scopeWhereLearningEnv($query)
    {
        return $query->where('type', self::TYPE_LEARNING_ENV);
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_ref_posts',
            'product_id',
            'post_id'
        );
    }

    public function transform($conditions = ['categories' => false])
    {
        $categories = $this->categories
            ->where('status', self::STATUS_ACTIVE)
            ->values()
            ->map(fn($item) => $item->transform());

        $images = collect($this->images)->map(function ($image) {
            return $this->getImageDetail($image);
        })->toArray();

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'published_at' => $this->published_at,
            'description' => $this->description,
            'category' => $this->category,
            'categories' => $categories,
            'images' => $images,
            'image' => $this->getImageDetail($this->image),
            'icon' => $this->getImageDetail($this->icon),
            'url' => $this->current_url,
            'link' => $this->link,
            'resource_type' => $this->resource_type,
            'price' => $this->price,

            'number_of_course' => $this->number_of_course,
            'timetable' => $this->timetable,

            'schedule' => $this->schedule,
            'groups' => $this->groups,
            'course_for' => $this->course_for,
            'knowledge_content' => $this->knowledge_content,
            'course_target' => $this->course_target,
        ];

        if (isset($conditions['categories']) && $conditions['categories']) {
            $data['categories'] = $this->categories
                ->where('status', self::STATUS_ACTIVE)
                ->values()
                ->map(fn($item) => $item->transform());
        }

        return $data;
    }

    public function transformFeedback()
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'description' => $this->description,
            'content' => $this->content,
            'category' => $this->category,
            'image' => $this->getImageDetail($this->image),
            'link' => $this->link,
            'icon' => $this->icon,
            'resource_type' => $this->resource_type,
        ];

        return $data;
    }

    public function transformMember()
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'description' => $this->description,
            'image' => $this->getImageDetail($this->image),
            'content' => $this->content,
        ];

        return $data;
    }

    public function transformFaqs()
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
        ];

        return $data;
    }

    public function transformResource()
    {
        $categories = $this->categories
            ->where('status', self::STATUS_ACTIVE)
            ->values()
            ->map(fn($item) => $item->transform());

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'published_at' => $this->published_at,
            'description' => $this->description,
            'category' => $this->category,
            'content' => $this->content,
            'categories' => $categories,
            'image' => $this->getImageDetail($this->image),
            'icon' => $this->getImageDetail($this->icon),
            'url' => $this->current_url,
            'link' => $this->link,
            'resource_type' => $this->resource_type,
            'price' => $this->price,

            'number_of_course' => $this->number_of_course,
            'timetable' => $this->timetable,

            'schedule' => $this->schedule,
            'groups' => $this->groups,
            'course_for' => $this->course_for,
            'knowledge_content' => $this->knowledge_content,
            'course_target' => $this->course_target,
        ];

        if (isset($conditions['categories']) && $conditions['categories']) {
            $data['categories'] = $this->categories
                ->where('status', self::STATUS_ACTIVE)
                ->values()
                ->map(fn($item) => $item->transform());
        }

        return $data;
    }

    public function transformDetails()
    {
        $categories = $this->categories
            ->where('status', self::STATUS_ACTIVE)
            ->values()
            ->map(fn($item) => $item->transform());

        $images = collect($this->images)->map(function ($image) {
            return $this->getImageDetail($image);
        })->toArray();

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->seo_slug ?? $this->slug,
            'author' => $this->author,
            'published_at' => $this->published_at,
            'download' => $this->download,
            'description' => $this->description,
            'content' => transform_richtext($this->content),
            'take_note' => transform_richtext($this->take_note),
            'category' => $this->category,
            'categories' => $categories,
            'breadcrumbs' => $this->getBreadcrumbsAttribute(),
            'image' => $this->getImageDetail($this->image),
            'banner' => $this->getImageDetail($this->banner),
            'banner_mobile' => $this->getImageDetail($this->banner_mobile),
            'url' => $this->current_url,
            'link' => $this->link,
            'images' => $images,

            'icon' => $this->icon,
            'resource_type' => $this->resource_type,
            'price' => $this->price,

            'number_of_course' => $this->number_of_course,
            'timetable' => $this->timetable,

            'schedule' => $this->schedule,
            'groups' => $this->groups,
            'course_for' => $this->course_for,
            'knowledge_content' => $this->knowledge_content,
            'course_target' => $this->course_target,

            'products' => $this->products
                ->map(fn($item) => $item->transform()),
        ];

        return $data;
    }

    public function getImageDetail($image)
    {
        return [
            'url' => isset($image['path']) ? static_url($image['path']) : null,
            'alt' => $image['alt'] ?? $this->title,
        ];
    }

    public function transformSeo()
    {
        return transform_seo($this);
    }

    public function getBreadcrumbsAttribute()
    {
        $category = $this->categories()
            ->with('parentNode')
            ->where('status', PostCategory::STATUS_ACTIVE)
            ->orderBy('parent_id', 'desc')
            ->first();

        return PostCategory::transformAsBreadcrumb($category);
    }

    public function getTags()
    {
        return $this->tags
            ->where('status', self::STATUS_ACTIVE)
            ->values()
            ->map(fn($item) => $item->transform());
    }

    public function related($condition = [])
    {
        $limit = empty($condition['limit']) ? 8 : $condition['limit'];

        $relatedPosts = $this->relatedPosts
            ->where('status', self::STATUS_ACTIVE);

        if (!empty($condition['has_category'])) {
            $relatedPosts = $relatedPosts->where(function ($collection) {
                return $collection->categories
                    ->where('status', self::STATUS_ACTIVE)
                    ->count() > 0;
            });
        }

        $relatedPosts = $relatedPosts->values()->take($limit);

        $relatedPostIds = [];

        if ($relatedPosts->count() > 0) {
            $relatedPostIds = $relatedPosts->pluck('id');
        }

        if (count($relatedPosts) < $limit) {
            $addPosts = self::query()
                ->active()
                ->when($this->category['id'] ?? false, function ($query) {
                    $query->whereHas('categories', function ($query) {
                        $query->where('post_categories.id', $this->category['id']);
                    });
                })
                ->where('id', '<>', $this->id)
                ->whereNotIn('id', $relatedPostIds)
                ->take($limit - count($relatedPosts))
                ->get();

            if (count($addPosts) > 0) {
                $relatedPosts = $relatedPosts->concat($addPosts);
            }
        }

        return $relatedPosts->map(fn($item) => $item->transform());
    }

    public function scopeOrderByPosition($query)
    {
        return $query->orderByRaw('ISNULL(position) OR position = 0, position ASC');
    }

    public function scopeOrderByHomePosition($query)
    {
        return $query->orderByRaw('ISNULL(home_position) OR home_position = 0, home_position ASC');
    }

    public function scopeOrderByFooterPosition($query)
    {
        return $query->orderByRaw('ISNULL(footer_position) OR footer_position = 0, footer_position ASC');
    }

    public function scopeWhereFooter($query)
    {
        return $query->where(function ($query) {
            $query->whereNotNull('footer_position')->where('footer_position', '>', 0);
        })
            ->orderByFooterPosition()
            ->orderBy('id', 'desc');
    }

    public function scopeFilter(Builder $query, array $filters = []): Builder
    {
        $query->when($filters['tag'] ?? false, function (Builder $query, $value) {
            $query->whereHas('categories', function ($query) use ($value) {
                $query->whereHas('translations', function ($query) use ($value) {
                    $query->whereSlug($value);
                });
            });
        });

        $query->when($filters['sort'] ?? 'default', function (Builder $query, $value) {
            switch ($value) {
                case 'position':
                    $query->orderByPosition();
                    break;
                case 'home_position':
                    $query->orderByHomePosition();
                    break;
                default:
                    $query->orderBy('published_at', 'desc');
                    break;
            }
        });

        $query->orderBy('id', 'desc');

        $query->when($filters['keyword'] ?? false, function (Builder $query, $keyword) {
            $query->search($keyword);
        });

        $query->when($filters['limit'] ?? false, function (Builder $query, $value) {
            $query->take($value);
        });

        $query->when($filters['limit'] ?? false && !$filters['paginate'] ?? true, function (Builder $query, $value) {
            $query->take($value);
        });

        return $query;
    }

    public function getImageUrlAttribute()
    {
        return isset($this->image['path']) ? static_url($this->image['path']) : null;
    }
}
