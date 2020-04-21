<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function rolesUsers()
    {
        return $this->belongsToMany(User::class);

    }

    public function rolesRadiologists()
    {
        return $this->belongsToMany(Radiologist::class);

    }

    public function rolesHospitals()
    {
        return $this->belongsToMany(Hospital::class);

    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);

    }
}
