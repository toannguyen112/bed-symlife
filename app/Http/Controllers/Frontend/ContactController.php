<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\File;
use Illuminate\Support\Facades\Notification;
use App\Http\Notifications\CommonNotification;

class ContactController extends Controller
{
    public $model = Contact::class;

    public function store(Request $request)
    {
        try {

            $requestData = $request->all()['contact'];

            if (isset($requestData['images'])) {
                $files = $requestData['images'];
                $file = new File('Contact');
                $fileUploaded = $file->store($files);

                $images = [];

                if (isset($fileUploaded['successFiles'])) {
                    foreach ($fileUploaded['successFiles'] as $item) {
                        $images[] = [
                            'path' => str_replace('/static/', '', $item)
                        ];
                    }
                }

                $requestData['images'] = $images;
            }

            $this->model::create($requestData);

            return redirect()->back()->withSuccess('success');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function sendEmail($contact, $mailNotification = null)
    {
        if ($contact->status === Contact::STATUS_IS_SPAM) {
            $emails = explode(',', config('contact.mail_spam', 'khapcn.flamedia@gmail.com'));

            $data['mail_title'] = config('contact.message.new_spam', 'Thông báo nhận được Spam');

            $data = array_merge($data, $contact->data);

            $route = config('contact.types.' . $contact->type . '.route');

            $data['url'] = route(current_locale() . '.admin.' . $route . '.form', ['id' => $contact->id]);

            foreach ($emails as $email) {
                Notification::route('mail', $email)
                    ->notify(new CommonNotification($data));
            }
        } else {
            $emails = empty($mailNotification) ? explode(',', notification_to()) : explode(',', $mailNotification);
            $data['mail_title'] = config('contact.message.new_contact');

            $contactData = $contact->data;
            $emailData = [
                'mail_title' => config('contact.message.new_contact')
            ];

            if ($contact->type == 'CONTACT_FORM') {
                $emailData = array_merge($emailData, [
                    'Name' => $contactData['Họ và tên'],
                    'Phone' => $contactData['Số điện thoại'],
                    'Email' => $contactData['Email'],
                    'Note' => $contactData['Nội dung cần hỗ trợ'],
                    'Service' => $contactData['Service']['title'],
                    'Service link' => route(current_locale() . '.services.show', ['slug' => $contactData['Service']['slug']]),
                    'url' => route(current_locale() . '.admin.contacts.form', ['id' => $contact->id])
                ]);
            } else if ($contact->type == 'APPLY_FORM') {
                $files = [];

                foreach ($contactData['File CV'] as $index => $cv) {
                    $link = str_replace(' ', '%20', str_replace("/static/", "/storage/", config('app.url') . $cv));
                    $files['File CV ' . $index + 1] = 'File CV: <a href="' . $link . '">' . $link . '</a>';
                }

                $emailData = array_merge($emailData, [
                    'Name' => $contactData['Họ và tên'],
                    'Phone' => $contactData['Phone'],
                    'Email' => $contactData['Email'],
                    'Job' => $contactData['Job']['title'],
                    'Job link' => route(current_locale() . '.jobs.show', ['slug' => $contactData['Job']['slug']]),
                    'File cv' => $files,
                    'url' => route(current_locale() . '.admin.applies.form', ['id' => $contact->id])
                ]);
            }

            foreach ($emails as $email) {
                Notification::route('mail', $email)
                    ->notify(new CommonNotification($emailData));
            }
        }

        // send customer
        if (method_exists($contact, 'transformEmailDetails')) {
            $data = $contact->transformEmailDetails();

            if (isset($data['File CV']['CV 1'])) {
                $data['File CV']['CV 1'] = 'File CV: <a href="' . $data['File CV']['CV 1'] . '">' . $data['File CV']['CV 1'] . '</a>';
            }
        } else {
            $data = $contact->data;
        }

        $data['mail_title'] = config('contact.message.success_form');
        if (isset($data['Email'])) {
            $emailTo = $data['Email'];

            Notification::route('mail', $emailTo)
                ->notify(new CommonNotification($data));
        }
    }
}
