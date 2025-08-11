<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Models\Contact;
use App\Traits\HasCrudActions;

class ContactCheckoutCourseController extends Controller
{
    use HasCrudActions;
    public $model = Contact::class;

    private function getTable()
    {
        return 'FormCheckoutCourse';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'TYPE_CHECKOUT_COURSE')
            ->orderBy('id', 'DESC');
    }
}
