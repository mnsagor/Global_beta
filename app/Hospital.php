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

    const STATUS_SELECT = [
        '1' => 'Active',
        '0' => 'Inactive',
    ];

    public static $searchable = [
        'title',
        'hospital_code',
        'address',
        'manager_name',
        'manager_phone_number',
        'receptionist_name',
        'receptionist_phone_number',
        'route_title',
        'route_ae_title',
        'pacs_destinaiton_ae_title',
        'pacs_ae_title',
        'pacs_port',
        'proprietor_name',
        'proprietor_phone_number',
    ];

    protected $fillable = [
        'title',
        'status',
        'created_at',
        'hospital_code',
        'address',
        'manager_name',
        'manager_phone_number',
        'techonologist_name',
        'technologist_phone_number',
        'receptionist_name',
        'receptionist_phone_number',
        'route_title',
        'route_ae_title',
        'route_host_name',
        'route_port',
        'pacs_destinaiton_ae_title',
        'pacs_ae_title',
        'pacs_host_name',
        'pacs_port',
        'proprietor_name',
        'proprietor_phone_number',
        'chairman_name',
        'chairman_phone_number',
        'director_name',
        'director_phone_number',
        'accountant_name',
        'accountant_phone_number',
        'created_by_id',
        'updated_at',
        'deleted_at',
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
