<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Models\AuditLog;

class AuditLogController
{
    public function index()
    {
        $auditLogs = AuditLog::query()
            ->with('admin:id,name')
            ->latest()
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.setting.auditLogs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        $auditLog->load('admin:id,name');

        return view('dashboard.setting.auditLogs.show', compact('auditLog'));
    }
}
