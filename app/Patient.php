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

class Patient extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'patients';

    protected $appends = [
        'files',
    ];

    const GENDER_RADIO = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    protected $dates = [
        'dof',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'name',
        'email',
        'phone_number',
        'nid',
        'files',
    ];

    protected $fillable = [
        'name',
        'gender',
        'dof',
        'email',
        'phone_number',
        'nid',
        'clinical_history',
        'surgical_history',
        'lab_results',
        'deo_comments',
        'clinical_diagnosis',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function patientWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, 'patient_id', 'id');

    }

    public function getDofAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setDofAttribute($value)
    {
        $this->attributes['dof'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
