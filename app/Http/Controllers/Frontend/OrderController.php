<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\File;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->only(['rate_score', 'product_id', 'name', 'content', 'images']);

        $validator = Validator::make($data, [
            'rate_score' => 'required|numeric|min:1|max:5',
            'product_id' => 'required',
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if (isset($data['images'])) {
            $files = $data['images'];
            $file = new File('Rating');

            $fileUploaded = $file->store($files);

            $images = [];

            if (isset($fileUploaded['successFiles'])) {
                foreach ($fileUploaded['successFiles'] as $item) {
                    $images[] = [
                        'path' => str_replace('/static/', '', $item)
                    ];
                }
            }

            $data['images'] = $images;
        }

        $data['status'] = Rating::STATUS_INACTIVE;
        $this->model::create($data);

        return redirect()->back()->withSuccess('success');
    }
}
