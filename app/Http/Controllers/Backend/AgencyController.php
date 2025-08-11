<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use JamstackVietnam\Agency\Models\Agency;
use JamstackVietnam\Core\Traits\HasCrudActions;

class AgencyController extends Controller
{
    use HasCrudActions;
    public $model = Agency::class;
}
