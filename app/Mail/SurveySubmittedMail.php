<?php

namespace App\Mail;

use App\Models\SurveyAnswer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;




//Mailable


class SurveySubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(SurveyAnswer $surveyAnswer)
    {
        $this->surveyAnswer = $surveyAnswer;
    }

    public function build()
    {
        return $this->subject('Nouvelle réponse au sondage')
            ->view('emails.survey-Submit-Mail')
            ->with(['answer' => $this->surveyAnswer]);
    }
}
