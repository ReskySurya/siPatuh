<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hhmdsaved extends Model
{
    use HasFactory;

    protected $fillable = [
        'operatorName',
        'testDateTime',
        'location',
        'deviceInfo',
        'certificateInfo',
        'terpenuhi',
        'tidakterpenuhi',
        'test1',
        'test2',
        'test3',
        'testCondition1',
        'testCondition2',
        'result',
        'notes',
        'status',
        'submitted_by',
        'officerName',
        'supervisorName',
        'officer_signature',
        'supervisor_signature'
    ];

    protected $casts = [
        'testDateTime' => 'datetime',
        'terpenuhi' => 'boolean',
        'tidakterpenuhi' => 'boolean',
        'test1' => 'boolean',
        'test2' => 'boolean',
        'test3' => 'boolean',
        'testCondition1' => 'boolean',
        'testCondition2' => 'boolean',
    ];
}
