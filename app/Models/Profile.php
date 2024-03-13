<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function division()
    {
      return $this->belongsTo(Division::class);
    }
    public function district()
    {
      return $this->belongsTo(District::class);
    }
    public function thana()
    {
      return $this->belongsTo(Thana::class);
    }

}
