<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hhmdsaved extends Model
{
    use HasFactory;

    protected $table = 'hhmdsaveds';

    protected $fillable = [
        'operatorName',
        'testDateTime',
        'location',
        'deviceInfo',
        'certificateInfo',
        'terpenuhi',
        'tidakterpenuhi',
        'test2',
        'testCondition1',
        'testCondition2',
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
        'terpenuhi' => 'boolean',
        'tidakterpenuhi' => 'boolean',
        'test2' => 'boolean',
        'testCondition1' => 'boolean',
        'testCondition2' => 'boolean',
        'reviewed_at' => 'datetime'
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'submitted_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
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

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
