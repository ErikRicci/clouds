<?php

namespace Clouds\Controllers;

use Clouds\Utils\Cache\Cerebro;
use Oracle\Oracle;
use R2SSimpleRouter\Request;
use R2SSimpleRouter\Response;

class AuthenticationController
{
    public function login()
    {
        $login = Request::get('login');
        $password = Request::get('password');
        $try = openssl_encrypt(json_encode(['username' => $login]), 'DES-CFB', $password, iv: 'GHSADQQA');
        $user = Oracle::getInstance()->select("SELECT * FROM users WHERE username = '$login'");

        if (empty($user)) {
            throw new \Exception('User not found');
        }

        if ($user[0]['password'] != $try) {
            throw new \Exception('Bad password');
        }

        $login_ttl = 10;
        $user_key = "user_{$login}";

        if ($user_data = Cerebro::get($user_key)) {
            Response::success([
                'logged' => false,
                'account' => $user_data,
            ]);
        }

        $logged_at = date('Y-m-d H:i:s');
        $expires_at = (new \DateTime($logged_at))->modify("+$login_ttl seconds")->format('Y-m-d H:i:s');
        $user_data = [
            'login' => $login,
            'logged_at' => $logged_at,
            'expires_at' => $expires_at,
        ];
        $success = Cerebro::put($user_key, json_encode($user_data), 10);

        Response::success([
            'logged' => $success,
            'account' => $user_data,
        ]);
    }
}