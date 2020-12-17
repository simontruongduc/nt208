<?php

namespace App\Http\Controllers\Web;

use App\Enums\MessageStatusEnum;
use App\Http\Requests\Web\FeedbackRequest;
use App\Models\Message;

/**
 * Class FeedbackController
 *
 * @package App\Http\Controllers\Web
 */
class MessageController extends WebController
{
    /**
     * @param \App\Http\Requests\Web\FeedbackRequest $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder
     */
    public function feedback(FeedbackRequest $request)
    {
        $data = $request->validated();
        $data['status'] = MessageStatusEnum::NEW_MESSAGE;
        $user = Message::query()->create($data);
        $this->sendWithHtml("EmailTemplate.Feedback", $user, 'Feedback');

        return $this->success();
    }
}
