<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuiz extends Model
{
    protected $table = 'student_quizs';
    public $timestamps = false;

    public function nameQuiz()
    {
        $quiz = Quiz::find($this->quiz_id);
        if ($quiz) {
            return $quiz->name;
        }
    }
}
