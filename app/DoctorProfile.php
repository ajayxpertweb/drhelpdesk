<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $fillable = [
        'degree', 'college', 'completed_year','hospital_name','experience_from','experience_to','designation','awards','award_year','registration','registration_year' 
    ];
}
