<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'stdClass',
        'schoolName',
        'villageName',
        'fatherName',
        'motherName',
        'numberOfSisters',
        'numberOfBrothers',
        'district',
        'diocese',
        'state',
        'cellNumber',
        'homeAddress',
    ];
}
