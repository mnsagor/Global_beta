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

class Modality extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, HasMediaTrait, Auditable;

    public $table = 'modalities';

    public static $searchable = [
        'title',
        'details',
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

    protected $fillable = [
        'title',
        'status',
        'details',
        'created_at',
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
        Modality::observe(new \App\Observers\ModalityActionObserver);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);

    }

    public function modalityProcedures()
    {
        return $this->hasMany(Procedure::class, 'modality_id', 'id');

    }

    public function modalityMacros()
    {
        return $this->hasMany(Macro::class, 'modality_id', 'id');

    }

    public function modalityWorkOrders()
    {
        return $this->hasMany(WorkOrder::class, 'modality_id', 'id');

    }

    public function modalityRadiologists()
    {
        return $this->belongsToMany(Radiologist::class);

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
