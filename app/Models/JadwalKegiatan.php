<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKegiatan extends Model
{
    protected $fillable = [
        'waktu', 'kegiatan', 'tempat_acara', 'leading_sektor', 'pakaian', 'keterangan', 'created_by', 'updated_by',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->created_by = auth()->check() ? auth()->user()->id : 0;
            $model->updated_by = auth()->check() ? auth()->user()->id : 0;
        });
        self::updating(function ($model) {
            $model->updated_by = auth()->check() ? auth()->user()->id : 0;
        });
    }

    public function getCreatedBy()
    {
        return $this->belongsTo('App\User', 'created_by', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }

    public function getUpdatedBy()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }

    public function getDetails()
    {
        return $this->hasMany('App\Models\JadwalKegiatanDetail', 'kegiatan_id', 'id');
    }
}
