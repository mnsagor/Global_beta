<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class WorkOrder extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'work_orders';

    protected $appends = [
        'image',
    ];

    public static $searchable = [
        'registration_number',
    ];

    protected $dates = [
        'data',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'data',
        'doctor_id',
        'created_at',
        'patient_id',
        'updated_at',
        'deleted_at',
        'hospital_id',
        'modality_id',
        'created_by_id',
        'uploaded_by_id',
        'radiologist_id',
        'registration_number',
        'work_order_status_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        WorkOrder::observe(new \App\Observers\WorkOrderActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function work_order_status()
    {
        return $this->belongsTo(WorkOrderStatus::class, 'work_order_status_id');

    }

    public function uploaded_by()
    {
        return $this->belongsTo(User::class, 'uploaded_by_id');

    }

    public function getDataAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;

    }

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;

    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id');

    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');

    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');

    }

    public function modality()
    {
        return $this->belongsTo(Modality::class, 'modality_id');

    }

    public function procedures()
    {
        return $this->belongsToMany(Procedure::class);

    }

    public function radiologist()
    {
        return $this->belongsTo(Radiologist::class, 'radiologist_id');

    }

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
        });

        return $files;

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
