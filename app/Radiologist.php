<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Radiologist extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'radiologists';

    protected $appends = [
        'signature_image',
    ];

    const GENDER_SELECT = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public static $searchable = [
        'phone_number',
        'address',
        'designation',
    ];

    protected $fillable = [
        'created_at',
        'name',
        'status',
        'phone_number',
        'address',
        'designation',
        'gender',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        Radiologist::observe(new \App\Observers\RadiologistActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function radiologistWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, 'radiologist_id', 'id');

    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class);

    }

    public function modalities()
    {
        return $this->belongsToMany(Modality::class);

    }

    public function macros()
    {
        return $this->belongsToMany(Macro::class);

    }

    public function getSignatureImageAttribute()
    {
        $file = $this->getMedia('signature_image')->last();

        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
