<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Writer;

// بعد إضافة الآدمن للكاتب فإنه يرسل إشعار للكاتب بأنه تم تسجيله في الموقع
// حيث قمنا بإنشاء هذا الإعلان عن طريق كتابة هذه التعليمة في التيرمينل
// php artisan make:notification WriterCreated
// و تم إنشاء مجلد  اسمه إعلانات
class WriterCreated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    // الآدمن يرسل الإشعارات للكتاب
    public $writer;
    public function __construct(Writer $writer)
    // Writer $writer
    // هذا هو أي كاتب رح ينّشئ و يجي من الكونترولر
    {
        //يعني زس أوف الرايتر يلي من فوق الدالة بيساوي الغرض رايتر الممر
        $this->writer=$writer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // (sms) نوع الإعلان : هل هو إيميل أم هي 
    // أو عن طريق قاعدة البيانات أو جميعها معا
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // نكتب فيه (إالى أين يتم إرسال الإيميل)
    public function toMail(object $notifiable): MailMessage
    {
        // $this->Writer->name من مدير الموقع احمد مثلا
        $subject = sprintf('%s: لقد تم انشاء حسابك في موقع الخدمات الطلابي %s!', config('app.name'),$this->writer->name );
        $greeting = sprintf('مرحبا %s!', $notifiable->name);

        return (new MailMessage)
        ->subject($subject)
        ->greeting($greeting)
        // العنوان في الايميل
        ->salutation('Yours Faithfully')
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
