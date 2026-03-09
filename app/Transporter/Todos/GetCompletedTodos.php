<?php

namespace App\Transporter\Todos;

use App\Transporter\JsonPlaceholderRequest;

class GetCompletedTodos extends JsonPlaceholderRequest
{
    protected string $method = 'GET';

    protected string $path = '/todos?completed=true';
}