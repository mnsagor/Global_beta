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
        'nid',
        'name',
        'email',
        'files',
        'phone_number',
    ];

    protected $fillable = [
        'dof',
        'nid',
        'name',
        'email',
        'gender',
        'created_at',
        'updated_at',
        'deleted_at',
        'lab_results',
        'phone_number',
        'deo_comments',
        'created_by_id',
        'clinical_history',
        'surgical_history',
        'clinical_diagnosis',
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
