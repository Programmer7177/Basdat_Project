<?php

namespace App\Notifications;

use App\Models\FacilityReport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReportOverdue extends Notification
{
    use Queueable;

    public $report;

    public function __construct(FacilityReport $report)
    {
        $this->report = $report;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'message' => 'Peringatan: Laporan "' . $this->report->title . '" belum ditanggapi lebih dari 1 hari.',
            'url' => route('reports.show', $this->report->report_id),
        ];
    }
}