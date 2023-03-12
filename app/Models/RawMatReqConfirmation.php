<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMatReqConfirmation extends Model
{
    use HasFactory;

    protected $fillable = ['raw_mat_req_id', 'user_id', 'status', 'confirmed_at'];

    public function request()
    {
        return $this->belongsTo(related: RawMaterialRequest::class, foreignKey: 'raw_mat_req_id');
    }


    public function user()
    {
        return $this->belongsTo(related: User::class, foreignKey: 'user_id');
    }
}
