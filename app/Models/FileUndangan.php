<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileUndangan extends Model
{
    protected $fillable = [
        'name', 'file', 'created_by', 'updated_by',
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
}
