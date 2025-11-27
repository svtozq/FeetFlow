<?php

namespace App\Events;

use App\Models\Survey;
use App\Models\SurveyAnswer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class DailyAnswersThresholdReached
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Survey $survey;  //info du questionnaire
    public Collection $answers; //stocker les reponse d'hier

    /**
     * Create a new event instance.
     */
    public function __construct(Survey $survey, Collection $answers)
    {
        $this->survey = $survey;
        $this->answers = $answers;
    }



    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
