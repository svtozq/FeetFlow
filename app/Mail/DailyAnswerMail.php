<?php

namespace App\Mail;

use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyAnswerMail extends Mailable
{
    use Queueable, SerializesModels;

    public Survey $survey;
    public Collection $answers;

    /**
     * Create a new message instance.
     */
    public function __construct(Survey $survey, Collection $answers)
    {
        $this->survey = $survey;
        $this->answers = $answers;
    }

    public function build(){

        return $this->subject('rapport quotidien dusondage : ' . $this->survey->title) //on recup le titre
            ->view('emails.daily-Answer-Mail')
            ->with([
                'survey'  => $this->survey,
                'answers' => $this->answers,
                'count'   => $this->answers->count(),
            ]);
    }
}
