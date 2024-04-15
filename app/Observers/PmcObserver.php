<?php

namespace App\Observers;

use App\Models\Conformidade;

class PmcObserver
{
    /**
     * Handle the Conformidade "created" event.
     */
    public function created(Conformidade $conformidade): void
    {
        //
    }

    /**
     * Handle the Conformidade "updated" event.
     */
    public function updated(Conformidade $conformidade): void
    {
        //
    }

    /**
     * Handle the Conformidade "deleted" event.
     */
    public function deleted(Conformidade $conformidade): void
    {
        //
    }

    /**
     * Handle the Conformidade "restored" event.
     */
    public function restored(Conformidade $conformidade): void
    {
        //
    }

    /**
     * Handle the Conformidade "force deleted" event.
     */
    public function forceDeleted(Conformidade $conformidade): void
    {
        //
    }
}
