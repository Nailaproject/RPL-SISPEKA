<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';

    protected $fillable = [
        'nip',
        'nama',
        'jk',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelasWali()
    {
        return $this->hasMany(Kelas::class,'wali_kelas_id');
    }
    public function teachingAssignments()
    {
        return $this->hasMany(TeachingAssignment::class);
    }

        public function laporan()
    {
        return $this->hasMany(LaporanSiswa::class, 'guru_id');
    }

}