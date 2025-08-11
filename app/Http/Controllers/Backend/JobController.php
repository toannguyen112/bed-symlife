<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use JamstackVietnam\Job\Models\Job;
use JamstackVietnam\Core\Traits\HasCrudActions;

class JobController extends Controller
{
    use HasCrudActions;
    public $model = Job::class;

    public $with = [
        'form' => ['relatedJobs']
    ];
}
