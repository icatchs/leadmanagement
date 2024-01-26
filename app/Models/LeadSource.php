<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LeadSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'source_status', 
        'description',
        'soft_delete',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'lead_source');
    }
 
    protected static function booted()
    {
        static::addGlobalScope('soft_delete', function (Builder $builder) {
            $builder->where('soft_delete', '<>', 1);
        });
    }
}
