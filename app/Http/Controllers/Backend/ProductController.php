<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product\Product;
use JamstackVietnam\Core\Traits\HasCrudActions;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    use HasCrudActions;
    public $model = Product::class;

    private function getTable()
    {
        return 'Products/Products';
    }

    public $with = [
        'index' => ['translations'],
        'form' => ['posts']
    ];
}
