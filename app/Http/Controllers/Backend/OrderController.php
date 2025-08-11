<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Traits\HasCrudActions;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class OrderController extends Controller
{
    use HasCrudActions;
    public $model = Order::class;

    public $appends = [
        'form' => ['formatted_created_at']
    ];

    public $with = [
        'form' => ['orderLines', 'orderLines.product']
    ];

    private function getTable()
    {
        return 'Products/Orders';
    }
}
