<?php

namespace App\Etc;

include __DIR__ . '/HttpErr.php';

class Response
{
    public function __construct( $status = 200, $json = [] )
    {
        $this->status = $status;
        $this->json   = $json;

        $this->dispatch();
    }

    private function dispatch()
    {
        header( 'Content-Type: application/json' );
        http_response_code( $this->status );
        echo json_encode( $this->json );
        exit;
    }
}

