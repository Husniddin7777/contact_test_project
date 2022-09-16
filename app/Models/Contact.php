<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function contact_phones()
    {
        return $this->hasMany(ContactPhone::class);
    }

    public function contact_emails()
    {
        return $this->hasMany(ContactEmail::class);
    }
}
