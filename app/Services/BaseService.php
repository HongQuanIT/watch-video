<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;

abstract class BaseService {
    // protected const PAGE = 1;
    // protected const PER_PAGE = 10;

    protected function sendMail($template, $data, $subject, $emailTo, $nameTo)
    {
        Mail::send($template, $data, function ($message) use ($subject,$emailTo,$nameTo) {
            $message->to($emailTo, $nameTo)
                ->subject($subject)
                ->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}
