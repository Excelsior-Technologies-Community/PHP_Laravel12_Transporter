<?php

namespace App\Transporter\Todos;

use App\Transporter\JsonPlaceholderRequest;

class GetTodos extends JsonPlaceholderRequest
{
    protected string $method = 'GET';

    protected string $path = '/todos';
}