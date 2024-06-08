<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class CostumersModel extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $timestamps = false;
    protected $table = 'customers';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * Rel;acion con region
     */
    public function region()
    {
        return $this->belongsTo(RegionsModel::class, 'id_reg');
    }
    /**
     * Relacion con Commune
     */
    public function commune()
    {
        return $this->belongsTo(CommunesModel::class, 'id_com');
    }
    /**
     * Campos visibles
     */
    protected $visible = ['name', 'last_name', 'address',   'region', 'commune'];
}
