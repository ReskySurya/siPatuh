<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wtmdsaved extends Model
{
    use HasFactory;

    protected $table = 'wtmdsaveds';

    protected $fillable = [
        'operatorName',
        'testDateTime',
        'location',
        'deviceInfo',
        'certificateInfo',
        'terpenuhi',
        'tidakterpenuhi',

        // Test Depan
        'test1_in_depan',
        'test1_out_depan',
        'test2_in_depan',
        'test2_out_depan',
        'test4_in_depan',
        'test4_out_depan',

        // Test Belakang
        'test3_in_belakang',
        'test3_out_belakang',

        // Form fields
        'result',
        'notes',
        'status',
        'submitted_by',
        'officerName',
        'supervisorName',
        'officer_signature',
        'supervisor_signature',
        'rejection_note',
        'reviewed_at',
        'reviewed_by',
        'supervisor_id'
    ];

    protected $casts = [
        'testDateTime' => 'datetime',
        'reviewed_at' => 'datetime',
        'terpenuhi' => 'boolean',
        'tidakterpenuhi' => 'boolean',

        // Test Depan
        'test1_in_depan' => 'boolean',
        'test1_out_depan' => 'boolean',
        'test2_in_depan' => 'boolean',
        'test2_out_depan' => 'boolean',
        'test4_in_depan' => 'boolean',
        'test4_out_depan' => 'boolean',

        // Test Belakang
        'test3_in_belakang' => 'boolean',
        'test3_out_belakang' => 'boolean'
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'submitted_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isPending()
    {
        return $this->status === 'pending_supervisor';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }
}
