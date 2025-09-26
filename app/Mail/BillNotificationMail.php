<?php

namespace App\Mail;

use App\Models\Bill;
use App\Models\BillPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BillNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $bill;
    public $payment;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct(Bill $bill, string $type = 'created', ?BillPayment $payment = null)
    {
        $this->bill = $bill;
        $this->type = $type;
        $this->payment = $payment;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->type === 'created'
            ? "New Bill Created - {$this->bill->billCategory->name}"
            : "Bill Payment Received - {$this->bill->billCategory->name}";

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->type === 'created'
            ? 'emails.bill_created'
            : 'emails.bill_paid';

        return new Content(
            view: $view,
            with: [
                'bill' => $this->bill,
                'payment' => $this->payment,
            ],
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
