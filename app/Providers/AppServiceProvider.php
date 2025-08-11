<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('settings')) {
            $smtp = \DB::table('settings')
                ->where('group', 'smtp')
                ->get();

            config([
                    'mail.from.name' => $smtp->firstWhere('name', 'mail_from_name')?->val ?? 'Example',
                    'mail.from.address' => $smtp->firstWhere('name', 'mail_from_address')?->val ?? 'hello@example.com',
                    'mail.mailers.smtp.host' => $smtp->firstWhere('name', 'mail_host')?->val ?? 'smtp.mailgun.org',
                    'mail.mailers.smtp.port' => $smtp->firstWhere('name', 'mail_port')?->val ?? 587,
                    'mail.mailers.smtp.encryption' => $smtp->firstWhere('name', 'mail_encryption')?->val ?? null,
                    'mail.mailers.smtp.username' => $smtp->firstWhere('name', 'mail_username')?->val ?? env('MAIL_USERNAME'),
                    'mail.mailers.smtp.password' => $smtp->firstWhere('name', 'mail_password')?->val ?? env('MAIL_PASSWORD'),
                ]
            );
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
