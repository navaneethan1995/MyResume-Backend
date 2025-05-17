<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    
    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function build()
    {
        return $this->from($this->data['email'], $this->data['name'])  
                    ->to('navanee7531@gmail.com')  
                    ->subject('New Contact Message from ' . $this->data['name'])
                    ->markdown('emails.contact')  
                    ->with('data', $this->data);  
    }
}
