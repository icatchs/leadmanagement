<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'company_name',
        'company_email',
        'company_phone',
        'company_city',
        'company_state',
        'contact_person',
        'company_status', 
        'soft_delete', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('soft_delete', function (Builder $builder) {
            $builder->where('soft_delete', '<>', 1);
        });
    }

   /*  $company = Company::find(1);
    $user = $company->user; */
}
