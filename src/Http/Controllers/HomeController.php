<?php
namespace Wandu\Api\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function index(ServerRequestInterface $request)
    {
        $user = $request->getAttribute('user');
        return [
            'success' => true,
            'message' => 'pong',
            'user' => $user,
        ];
    }
}
