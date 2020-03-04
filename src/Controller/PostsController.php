<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class PostsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'className' => 'MyAuth',
            'authorize' => 'Controller',
            'loginAction' => ['controller' => 'Users', 'action' => 'login']
        ]);
        $this->loadComponent('Cookie', ['expires' => '1 day']);
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->config('authorize', ['controller']);
        $this->Auth->config('loginAction', ['controler' => 'Users', 'action' => 'login']);
        $this->Cookie->config('name', 'CookieMonster');
    }

    public function sayHi()
    {
        $this->loadComponent('OneTimer');
        $time = $this->OneTimer->getTime();
    }
}
