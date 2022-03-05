<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function quizs()
    {
        return $this->hasMany(Quiz::class, 'subject_id', 'id');
    }
}
