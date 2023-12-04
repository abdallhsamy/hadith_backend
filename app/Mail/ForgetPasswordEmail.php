<?php

namespace App\Mail;

use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;

class ForgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private PasswordReset $passwordReset)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
            subject: __('general.verify_your_email'),
            using: [
                function (Email $email) {

                    // headers
                    $email->getHeaders()
                        ->addTextHeader('X-Message-Source', config('app.url'))
                        ->add(new UnstructuredHeader('X-Mailer', config('app.name').' Mail Client'));
                },
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.forget_password_email',
            with: ['passwordReset' => $this->passwordReset]
        );
    }
}
