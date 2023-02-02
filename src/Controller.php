<?php

declare(strict_types=1);

namespace KeyziPHP\SSE;

use App\SSE\Event;

// TODO: StopWorkerOnMemoryLimitListener(1024 * 1024 * 100)
// TODO: StopWorkerOnTimeLimitListener(60 * 10)

// TODO: get header last-event-id

class Controller {
    public static function init() {
        session_write_close();
        @ob_end_flush();
        set_time_limit(60 * 10 + 10);
    
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        header('X-Accel-Buffering: no'); // Nginx: unbuffered responses suitable for Comet and HTTP streaming applications
    
        echo new Event\Comment("Last event id: $last_event_id; Consumer id: $consumer_id");
        $sendOutput();
        echo new Event\JsonDataOnly(sprintf('Init; OB Level: "%s", INI output_buffering: "%s", INI zlib.output_compression: "%s"', 
            ob_get_level(), ini_get('output_buffering'), ini_get('zlib.output_compression')));
        $sendOutput();
    
        echo new Event\Comment("ping");
        $sendOutput();
    }
    
    public static function send_output(): void {
        if( ob_get_level() > 0 ) for( $i=0; $i < ob_get_level(); $i++ ) ob_flush();
        flush();
    }
    
    public static function assert_user_connected() {
        if(connection_aborted() || connection_status() != \CONNECTION_NORMAL) {
            throw new \Exception('User disconnected');
        }
    }
}