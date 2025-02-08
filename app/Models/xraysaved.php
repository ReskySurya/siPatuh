<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xraysaved extends Model
{
    use HasFactory;

    protected $table = 'xraysaveds';

    protected $fillable = [
        'operatorName',
        'testDateTime',
        'location',
        'deviceInfo',
        'certificateInfo',
        'terpenuhi',
        'tidakterpenuhi',

        // Generator Atas/Bawah
        'test2aab',
        'test2bab',
        'test3ab_14',
        'test3ab_16',
        'test3ab_18',
        'test3ab_20',
        'test3ab_22',
        'test3ab_24',
        'test3ab_26',
        'test3ab_28',
        'test3ab_30',

        // Test 1a dan 1b Atas/Bawah
        'test1aab_36',
        'test1aab_32',
        'test1aab_30',
        'test1aab_24',
        'test1bab_36_1',
        'test1bab_32_1',
        'test1bab_30_1',
        'test1bab_24_1',
        'test1bab_36_2',
        'test1bab_32_2',
        'test1bab_30_2',
        'test1bab_24_2',
        'test1bab_36_3',
        'test1bab_32_3',
        'test1bab_30_3',
        'test1bab_24_3',

        // Test 4 Atas/Bawah
        'test4ab_h10mm',
        'test4ab_v10mm',
        'test4ab_h15mm',
        'test4ab_v15mm',
        'test4ab_h20mm',
        'test4ab_v20mm',

        // Test 5 Atas/Bawah
        'test5ab_05mm',
        'test5ab_10mm',
        'test5ab_15mm',

        // Generator Bawah
        'test2ab',
        'test2bb',
        'test3b_14',
        'test3b_16',
        'test3b_18',
        'test3b_20',
        'test3b_22',
        'test3b_24',
        'test3b_26',
        'test3b_28',
        'test3b_30',

        // Test 1a dan 1b Bawah
        'test1ab_36',
        'test1ab_32',
        'test1ab_30',
        'test1ab_24',
        'test1bb_36_1',
        'test1bb_32_1',
        'test1bb_30_1',
        'test1bb_24_1',
        'test1bb_36_2',
        'test1bb_32_2',
        'test1bb_30_2',
        'test1bb_24_2',
        'test1bb_36_3',
        'test1bb_32_3',
        'test1bb_30_3',
        'test1bb_24_3',

        // Test 4 Bawah
        'test4b_h10mm',
        'test4b_v10mm',
        'test4b_h15mm',
        'test4b_v15mm',
        'test4b_h20mm',
        'test4b_v20mm',

        // Test 5 Bawah
        'test5b_05mm',
        'test5b_10mm',
        'test5b_15mm',

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

        // Generator Atas/Bawah
        'test2aab' => 'boolean',
        'test2bab' => 'boolean',
        'test3ab_14' => 'boolean',
        'test3ab_16' => 'boolean',
        'test3ab_18' => 'boolean',
        'test3ab_20' => 'boolean',
        'test3ab_22' => 'boolean',
        'test3ab_24' => 'boolean',
        'test3ab_26' => 'boolean',
        'test3ab_28' => 'boolean',
        'test3ab_30' => 'boolean',

        // Test 1a dan 1b Atas/Bawah
        'test1aab_36' => 'boolean',
        'test1aab_32' => 'boolean',
        'test1aab_30' => 'boolean',
        'test1aab_24' => 'boolean',
        'test1bab_36_1' => 'boolean',
        'test1bab_32_1' => 'boolean',
        'test1bab_30_1' => 'boolean',
        'test1bab_24_1' => 'boolean',
        'test1bab_36_2' => 'boolean',
        'test1bab_32_2' => 'boolean',
        'test1bab_30_2' => 'boolean',
        'test1bab_24_2' => 'boolean',
        'test1bab_36_3' => 'boolean',
        'test1bab_32_3' => 'boolean',
        'test1bab_30_3' => 'boolean',
        'test1bab_24_3' => 'boolean',

        // Test 4 Atas/Bawah
        'test4ab_h10mm' => 'boolean',
        'test4ab_v10mm' => 'boolean',
        'test4ab_h15mm' => 'boolean',
        'test4ab_v15mm' => 'boolean',
        'test4ab_h20mm' => 'boolean',
        'test4ab_v20mm' => 'boolean',

        // Test 5 Atas/Bawah
        'test5ab_05mm' => 'boolean',
        'test5ab_10mm' => 'boolean',
        'test5ab_15mm' => 'boolean',

        // Generator Bawah
        'test2ab' => 'boolean',
        'test2bb' => 'boolean',
        'test3b_14' => 'boolean',
        'test3b_16' => 'boolean',
        'test3b_18' => 'boolean',
        'test3b_20' => 'boolean',
        'test3b_22' => 'boolean',
        'test3b_24' => 'boolean',
        'test3b_26' => 'boolean',
        'test3b_28' => 'boolean',
        'test3b_30' => 'boolean',

        // Test 1a dan 1b Bawah
        'test1ab_36' => 'boolean',
        'test1ab_32' => 'boolean',
        'test1ab_30' => 'boolean',
        'test1ab_24' => 'boolean',
        'test1bb_36_1' => 'boolean',
        'test1bb_32_1' => 'boolean',
        'test1bb_30_1' => 'boolean',
        'test1bb_24_1' => 'boolean',
        'test1bb_36_2' => 'boolean',
        'test1bb_32_2' => 'boolean',
        'test1bb_30_2' => 'boolean',
        'test1bb_24_2' => 'boolean',
        'test1bb_36_3' => 'boolean',
        'test1bb_32_3' => 'boolean',
        'test1bb_30_3' => 'boolean',
        'test1bb_24_3' => 'boolean',

        // Test 4 Bawah
        'test4b_h10mm' => 'boolean',
        'test4b_v10mm' => 'boolean',
        'test4b_h15mm' => 'boolean',
        'test4b_v15mm' => 'boolean',
        'test4b_h20mm' => 'boolean',
        'test4b_v20mm' => 'boolean',

        // Test 5 Bawah
        'test5b_05mm' => 'boolean',
        'test5b_10mm' => 'boolean',
        'test5b_15mm' => 'boolean'
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
