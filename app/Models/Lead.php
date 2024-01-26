<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lead extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'lead_source',
        'email',
        'phone',
        'from',
        'to',
        'enquiry_date',
        'adult_count',
        'travel_date',
        'assisgned_to',
        'remark',
        'lead_status',
        'user_id',
        'soft_delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_status');
    }
    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class, 'lead_source');
    }

    protected static function booted()
    {
        static::addGlobalScope('soft_delete', function (Builder $builder) {
            $builder->where('soft_delete', '<>', 1);
        });
    }
}
