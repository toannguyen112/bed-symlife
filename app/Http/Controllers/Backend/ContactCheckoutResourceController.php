<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Models\Contact;
use App\Traits\HasCrudActions;

class ContactCheckoutResourceController extends Controller
{
    use HasCrudActions;
    public $model = Contact::class;

    private function getTable()
    {
        return 'FormCheckoutResource';
    }

    private function beforeIndex($query)
    {
        return $query->where('type', 'TYPE_CHECKOUT_RESOURCE')
            ->orderBy('id', 'DESC');
    }
}
