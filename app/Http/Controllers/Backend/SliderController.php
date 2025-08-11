<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use JamstackVietnam\Slider\Models\Slider;
use JamstackVietnam\Core\Traits\HasCrudActions;

class SliderController extends Controller
{
    use HasCrudActions;
    public $model = Slider::class;

    private function beforeIndex($query)
    {
        if (request()->has('filters.position') && request()->input('filters.position') != 'ALL') {
            $query->where('position_display', request()->input('filters.position'));
        }
        return $query;
    }
}
