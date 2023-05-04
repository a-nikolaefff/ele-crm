<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies
        = [
            // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Подтверждение email адреса')
                ->greeting('Здравствуйте')
                ->line(
                    'Нажмите на кнопку ниже, чтобы подтвердить регистрацию в EleCRM'
                )
                ->action('Подтвердить email', $url)
                ->salutation('С уважением, EleCRM');
        });

        ResetPassword::toMailUsing(function (object $notifiable, $url) {
            return (new MailMessage)
                ->subject('Сброс пароля')
                ->greeting('Здравствуйте')
                ->line(
                    'Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.'
                )
                ->action('Сбросить пароль', url('password/reset', $url) . '?email=' . $notifiable->email)
                ->line(
                    Lang::get(
                        'Срок действия этой ссылки для сброса пароля истекает через :count минут.',
                        [
                            'count' => config(
                                'auth.passwords.' . config(
                                    'auth.defaults.passwords'
                                ) . '.expire'
                            )
                        ]
                    )
                )
                ->salutation('С уважением, EleCRM');
        });
    }
}
