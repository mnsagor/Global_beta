<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Procedure extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable;

    public $table = 'procedures';

    public static $searchable = [
        'title',
        'status',
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
        'created_at',
        'updated_at',
        'deleted_at',
        'modality_id',
        'created_by_id',
        'procedure_type_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function procedureMacros()
    {
        return $this->hasMany(Macro::class, 'procedure_id', 'id');

    }

    public function procedureWorkOrders()
    {
        return $this->belongsToMany(WorkOrder::class);

    }

    public function modality()
    {
        return $this->belongsTo(Modality::class, 'modality_id');

    }

    public function procedure_type()
    {
        return $this->belongsTo(ProcedureType::class, 'procedure_type_id');

    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');

    }
}
