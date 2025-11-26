<?php

namespace App\Mail;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;




//Mailable


class SurveyClosedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Survey  $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function build()
    {
        return $this->subject("Un sondage vient d'expiré")
            ->view('emails.survey-Close-Mail')
            ->with(['survey' => $this->survey]);
    }
}

