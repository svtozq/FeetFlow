<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'closed',
        'is_anonymous',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    //Relation with user table
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relation with Organization table
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    //Relation with SurveyQuestion table
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id');
    }

    //Relation with Commands SendSurveyDailyReport
    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class);
    }


}
