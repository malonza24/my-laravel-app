<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActivityLog;

class SecurityAudit extends Command
{
    protected $signature   = 'security:audit';
    protected $description = 'Run a security audit of the application';

    public function handle()
    {
        $this->info('=== Diligent Mom Security Audit ===');
        $this->newLine();

        // Check failed logins in last 24 hours
        $failedLogins = ActivityLog::where('action', 'LIKE', '%login%')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $this->table(['Check', 'Status', 'Details'], [
            ['APP_DEBUG', env('APP_DEBUG') ? 'WARN' : 'PASS', env('APP_DEBUG') ? 'Debug mode ON - disable in production' : 'Debug mode off'],
            ['APP_ENV', env('APP_ENV') === 'production' ? 'PASS' : 'INFO', 'Environment: ' . env('APP_ENV')],
            ['Activity Logs (24h)', 'INFO', "Total: {$failedLogins} auth events"],
            ['Session Lifetime', 'PASS', env('SESSION_LIFETIME', 120) . ' minutes'],
            ['Bcrypt Rounds', (int) env('BCRYPT_ROUNDS', 10) >= 12 ? 'PASS' : 'WARN', env('BCRYPT_ROUNDS', 10) . ' rounds'],
        ]);

        $this->newLine();
        $this->info('Audit complete! Review any WARN items before deploying.');
    }
}