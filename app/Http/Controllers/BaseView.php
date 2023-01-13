<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class BaseView extends BaseController
{
    protected $head = [
        'title' => 'Laraflet'
    ];
    protected $data = [];
    protected $payload = [
        'head' => [],
        'content' => null,
        // string
        'data' => []
    ];

    private function encapsulatePayload()
    {
        $this->payload['head'] = (object) $this->head;
        $this->payload['data'] = (object) $this->data;

        $this->payload['payload'] = $this->payload;
        $this->payload['payload'] = $this->payload;
    }

    protected function render(string $content)
    {
        $this->payload['content'] = $content;
        $this->encapsulatePayload();

        return view('root', $this->payload);
    }
}