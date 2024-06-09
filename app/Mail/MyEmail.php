<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MyEmail extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(private $companyName, private $phone, private $email, private $message)
	{
		// 
	}

	/**
	 * Get the message envelope.
	 *
	 * @return \Illuminate\Mail\Mailables\Envelope
	 */
	public function envelope()
	{
		return new Envelope(
			from: new Address(env("MAIL_FROM_ADDRESS"), "Obitrans website"),
			subject: 'Hubungi kami, jangan ragu untuk menghubungi kami',
		);
	}

	/**
	 * Get the message content definition.
	 *
	 * @return \Illuminate\Mail\Mailables\Content
	 */
	public function content()
	{
		return new Content(
			view: 'email.contact',
			with: [
				"companyName" => $this->companyName,
				"phone" => $this->phone,
				"email" => $this->email,
				"msg" => $this->message
			]
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array
	 */
	public function attachments()
	{
		return [];
	}
}
