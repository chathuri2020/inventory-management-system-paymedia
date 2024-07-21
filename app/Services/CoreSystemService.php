<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CoreSystemService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://dpf.directpay.lk/';
    }

    public function addItem($item)
    {
        $response = Http::post($this->baseUrl . 'api/inventory/add', $item);
        return $response->json();
    }

    public function updateItem($item)
    {
        $response = Http::post($this->baseUrl . 'api/inventory/update', $item);
        return $response->json();
    }
    public function removeItem($item)
    {
        $response = Http::post($this->baseUrl . 'api/inventory/remove', $item);
        return $response->json();
    }
}
