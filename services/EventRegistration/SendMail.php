<?php

namespace services\EventRegistration;

use Yii;

class SendMail
{
    public static function sendWelcomeEmail($user)
    {
        Yii::$app->mailer->compose('@app/mail/report/create_user.php', [
            'user' => $user->username,
        ])
            ->setFrom('admin@site.ru')
            ->setTo('user@site.ru')
            ->setSubject('Регистрация нового пользователя на site.ru')
            ->send();

    }
}