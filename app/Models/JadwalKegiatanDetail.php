<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKegiatanDetail extends Model
{
    protected $fillable = [
        'kegiatan_id', 'user_id', 'absen', 'keterangan', 'created_by', 'updated_by',
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

    public function getAudience()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }

    public function getParentOfKegiatan()
    {
        return $this->belongsTo('App\Models\JadwalKegiatan', 'kegiatan_id', 'id');
    }
}
