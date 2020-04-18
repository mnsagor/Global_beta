<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Asset extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'assets';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'notes',
        'status_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
        'location_id',
        'serial_number',
        'assigned_to_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        Asset::observe(new \App\Observers\AssetsHistoryObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'category_id');

    }

    public function getPhotosAttribute()
    {
        return $this->getMedia('photos');

    }

    public function status()
    {
        return $this->belongsTo(AssetStatus::class, 'status_id');

    }

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');

    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');

    }
}
