<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'soft_delete',
        'remark',
    ] ;

    public function leads()
    {
        return $this->hasMany(Lead::class, 'lead_status');
    } 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
