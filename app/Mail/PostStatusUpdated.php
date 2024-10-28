<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $content;
    public $title;

    public function __construct(string $content, string $title)
    {
        $this->content = $content;
        $this->title = $title;
    }

    public function build()
    {
        return $this->subject('Post Status Update')
                    ->view('post_status_updated');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Post Status Updated',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'post_status_updated',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
