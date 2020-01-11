<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;

class InvoicePaid extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice;
    protected $user;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @param $invoice
     * @param $user
     */
    public function __construct($invoice, $user)
    {
        $this->invoice = $invoice;
        $this->user = $user;
        $this->message = $this->getMessage();
    }

    protected function getMessage() {
        switch($this->user->program) {
            case 'internship':
            case 'inter_relocat':
            case 'university':
                return __('mails.invoice.paid.body.application-fee', ['program' => __('content.programs.' . $this->user->program)]);
                break;
            default:
                return __('mails.invoice.paid.body.' . $this->user->program, ['program' => __('content.programs.' . $this->user->program)]);
                break;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->attach($this->invoice->invoice_pdf, [
                        'as' => $this->invoice->id . 'pdf',
                        'mime' => 'application/pdf'
                    ])
                    ->markdown('emails.invoices.paid')
                    ->with([
                        'userName' => $this->user->name,
                        'program' => $this->user->program,
                        'message' => $this->message,
                        'invoiceDetails' => [
                            'total' => numfmt_format_currency(numfmt_create(config('app.locale'), \NumberFormatter::CURRENCY), floatval($this->invoice->amount_paid / 100), config('services.stripe.cashier_currency')),
                            'date' => Carbon::parse($this->invoice->due_date, config('app.timezone'))->format('Y-m-d')
                        ],
                        'hostedInvoice' => $this->invoice->hosted_invoice_url,
                        'invoicePDF' => $this->invoice->invoice_pdf,
                    ]);
    }
}
