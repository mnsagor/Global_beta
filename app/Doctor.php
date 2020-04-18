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

class Doctor extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'doctors';

    const GENDER_RADIO = [
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
        'nid',
        'name',
        'email',
        'department',
        'designation',
        'specilities',
        'phone_number',
    ];

    protected $fillable = [
        'nid',
        'name',
        'email',
        'gender',
        'status',
        'address',
        'history',
        'department',
        'created_at',
        'updated_at',
        'deleted_at',
        'designation',
        'specilities',
        'phone_number',
        'created_by_id',
        'special_achievement',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        Doctor::observe(new \App\Observers\DoctorActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function doctorWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, 'doctor_id', 'id');

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
