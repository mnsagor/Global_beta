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
        'modality_id',
        'created_at',
        'procedure_type_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
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
        return $this->hasMany(WorkOrder::class, 'procedure_id', 'id');

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
