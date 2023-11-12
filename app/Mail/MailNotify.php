<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    private string $bank;
    private string $account;
    private string $address;
    private string $paymentMethod;
    private string $message;
    private string $totalAmount;
    /**
     * Create a new message instance.
     */
    public function __construct($bank, $account, $address, $paymentMethod, $message, $totalAmount)
    {
        //
        $this->bank = $bank;
        $this->account = $account;
        $this->address = $address;
        $this->paymentMethod = $paymentMethod;
        $this->message = $message;
        $this->totalAmount = $totalAmount;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'LKN Perfume Xác nhận thanh toán',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_confirmation',
            with: ['bank' => $this->bank,'account'=> $this->account,'address'=> $this->address,
            'paymentMethod'=>$this->paymentMethod,'message'=> $this->message,'totalAmount'=>$this->totalAmount],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
