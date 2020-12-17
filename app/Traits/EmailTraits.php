<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

/**
 * Trait EmailTraits
 *
 * @package App\Traits
 */
trait EmailTraits
{
    /**
     * @param $htmlPath
     * @param $data
     * @param $emailSubject
     */
    public function sendWithHtml($htmlPath, $data, $emailSubject)
    {
        $data = (object) $data;
        Mail::send(
            $htmlPath, ['data' => $data],
            function ($message) use ($data, $emailSubject) {
                $message->to($data->email);
                $message->subject($emailSubject);
            });
    }
}
