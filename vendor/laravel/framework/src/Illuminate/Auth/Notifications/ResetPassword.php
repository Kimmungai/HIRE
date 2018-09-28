<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('東京ハイヤーCLUBサポートデスクです。')
            ->line('アカウント パスワードを リセットするには、次の リンクをクリックしてください。')
            ->action('パスワードをリセット', url('password/reset', $this->token))
            ->line('このリンクをクリックしても機能しない場合は、URL をコピーして新しいブラウザ ウィンドウに貼り付けてください。')
            ->line('このメールに心当たりがない場合、他の方がパスワードをリセットする際に誤ってお客様のメール アドレスを入力した可能性があります。リクエストした覚えがない場合は、何も行わずにこのメールを破棄してください。')
            ->line('本メールは配信専用です。ご返信なさらぬようご注意ください。');
    }
}
