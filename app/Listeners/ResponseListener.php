<?php

namespace App\Listeners;

use Dingo\Api\Event\ResponseWasMorphed;

class ResponseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     *
     * @return void
     */
    public function handle(ResponseWasMorphed $event)
    {
        if (app('request')->has('forceDebugApi')) {
            $debugBar = app('debugbar');
            $event->content['_debugbar'] = $debugBar->getData();
        }

        if (app()->bound('debugbar') &&
            app('debugbar')->isEnabled() &&
            app()->env == 'local' &&
            app('request')->segments(1)[0] != 'html'
        ) {
            if (!app('request')->has('noDebug')) {
                $debugBar = app('debugbar');
                if (isset($event->content['_debugbar'])) {
                    $event->content['_debugbar'] = $debugBar->getData();
                }
            }
        }
    }
}
