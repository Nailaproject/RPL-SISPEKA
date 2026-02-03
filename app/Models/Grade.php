<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    protected $fillable = [
        'siswa_id','assignment_id','type','score','recorded_by'

    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function assignment()
    {
        return $this->belongsTo(TeachingAssignment::class, 'assignment_id');

    }

    public function recorder()
    {
        return $this->belongsTo(User::class,'recorded_by');
    }
}


