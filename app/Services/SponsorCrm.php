<?php

namespace App\Services;

use App\Models\Entry;
use Illuminate\Support\Facades\Log;

/**
 * Pushes every contest entry to the sponsor's CRM so they can follow up with the listener.
 *
 * In production this is an HTTP call to a third party API that is often slow.
 * Here we simulate that latency with a sleep (see SPONSOR_CRM_LATENCY_MS).
 */
class SponsorCrm
{
    public function push(Entry $entry): void
    {
        usleep(config('services.sponsor_crm.latency_ms') * 1000);

        Log::info('Entry pushed to sponsor CRM', [
            'entry_id' => $entry->id,
            'contest_id' => $entry->contest_id,
        ]);
    }
}
