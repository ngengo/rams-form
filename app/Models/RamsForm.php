<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RamsForm extends Model
{
    protected $table = 'rams_forms';
    protected $fillable = [
        'phone_no',
        'email_form',
        'club_name',
        'person_name',
        'today_date',
        'activity_type',
        'activity_date',
        'activity_objective',
        'cause_people',
        'cause_equipment',
        'cause_environment',
        'manage_operation_people',
        'manage_operation_equipment',
        'manage_operation_environment',
        'manage_emergency',
        'relevant_standards',
        'policies_guidelines',
        'staff_skills',
        'decision',
        'comments',
        'status',
    ];
}