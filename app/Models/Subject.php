<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('status');
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }
}
