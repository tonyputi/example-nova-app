<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;

class UpdateTitleStandAlone extends UpdateTitle
{
    use InteractsWithQueue, Queueable;

    /**
     * Indicates if the action can be run without any models.
     *
     * @var bool
     */
    public $standalone = true;
}
