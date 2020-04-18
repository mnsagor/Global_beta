<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class AssetsHistory extends Model
{
    public $table = 'assets_histories';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'asset_id',
        'status_id',
        'created_at',
        'updated_at',
        'location_id',
        'assigned_user_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');

    }

    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id');

    }

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');

    }

    public function assigned_user()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');

    }
}
