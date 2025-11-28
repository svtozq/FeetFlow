<?php

namespace App\Mail;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use App\Models\User;
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
     * Stocker les donnée a envoyer au Blade
     */
    public function __construct(

        public Survey $survey,

        public User $respondent,

        public array $answers
    ){}

    public function build()
    {
        return $this->subject('Nouvelle réponse au sondage')
            ->view('emails.survey-Submit-Mail')
            ->with([
                'survey'     => $this->survey,
                'respondent' => $this->respondent,
                'answers'    => $this->answers
            ]);
    }
}
