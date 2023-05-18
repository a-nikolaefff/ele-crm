<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies
        = [
            User::class => UserPolicy::class,
        ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject(__('email.verification.subject'))
                ->greeting(__('email.greeting'))
                ->line(__('email.verification.description'))
                ->action(__('email.verification.action'), $url)
                ->salutation(__('email.salutation'));
        });

        ResetPassword::toMailUsing(function (object $notifiable, $url) {
            return (new MailMessage)
                ->subject(__('email.reset.subject'))
                ->greeting(__('email.greeting'))
                ->line(__('email.reset.description'))
                ->action(
                    __('email.reset.action'),
                    url('password/reset', $url) . '?email=' . $notifiable->email
                )
                ->line(
                    Lang::get(
                        __('email.reset.warning'),
                        [
                            'count' => config(
                                'auth.passwords.' . config(
                                    'auth.defaults.passwords'
                                ) . '.expire'
                            )
                        ]
                    )
                )
                ->salutation(__('email.salutation'));
        });
    }
}
