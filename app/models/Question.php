<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['name', 'quiz_id'];
    public $timestamps = false;
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
