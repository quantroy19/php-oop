<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizs';
    protected $fillable = [
        'name', 'subject_id',
        'duration_minutes', 'start_time',
        'end_time', 'status', 'is_shuffle'
    ];
    public $timestamps = false;

    public function question()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id');
    }
    public function subjectName()
    {
        $sub = Subject::find($this->subject_id);
        if ($sub) {
            return $sub->name;
        }
        return false;
    }
}
