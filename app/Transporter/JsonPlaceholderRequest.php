<?php

namespace App\Transporter;

use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\Transporter\Request;

abstract class JsonPlaceholderRequest extends Request
{
    protected string $baseUrl = 'https://jsonplaceholder.typicode.com';
    public function withRequest(PendingRequest $request): void
    {
        $request->acceptJson();
    }
}
