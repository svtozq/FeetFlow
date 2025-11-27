<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;

    // ⚠️ ta table ne s’appelle sûrement pas "surveys" mais "survey_answers"
    protected $table = 'survey_answers';

    public $timestamps = true;

    protected $fillable = [
        'survey_id',
        'survey_question_id',
        'user_id',
        'answer',
    ];

    protected $casts = [
    ];
}
