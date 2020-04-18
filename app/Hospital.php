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

class Hospital extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'hospitals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'title',
        'address',
        'pacs_port',
        'route_title',
        'manager_name',
        'hospital_code',
        'pacs_ae_title',
        'route_ae_title',
        'receptionist_name',
        'manager_phone_number',
        'receptionist_phone_number',
        'pacs_destinaiton_ae_title',
    ];

    protected $fillable = [
        'title',
        'address',
        'pacs_port',
        'created_at',
        'deleted_at',
        'updated_at',
        'route_port',
        'route_title',
        'manager_name',
        'pacs_ae_title',
        'hospital_code',
        'created_by_id',
        'route_ae_title',
        'pacs_host_name',
        'route_host_name',
        'receptionist_name',
        'techonologist_name',
        'manager_phone_number',
        'receptionist_phone_number',
        'technologist_phone_number',
        'pacs_destinaiton_ae_title',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public static function boot()
    {
        parent::boot();
        Hospital::observe(new \App\Observers\HospitalActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function hospitalWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, 'hospital_id', 'id');

    }

    public function hospitalRadiologists()
    {
        return $this->belongsToMany(Radiologist::class);

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
