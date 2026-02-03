<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\TeachingAssignment;
use App\Models\Guru;

class Attendance extends Model
{
     protected $table = 'attendances';

    protected $fillable = [
        'siswa_id',
        'assignment_id',
        'date',
        'status',
        'recorded_by',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function assignment()
    {
        return $this->belongsTo(TeachingAssignment::class);
    }

    public function recorder()
    {
        return $this->belongsTo(Guru::class, 'recorded_by');
    }
}
