<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Controller\Component\AuthComponent;
use Cake\Event\Event;

class AppController extends Controller
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginRedirect' => [
                'controller' => 'Articles',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'home'
            ]
        ]);
    }

    public function isAuthorized($user)
    {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        return false;
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display']);

        /*Không yêu cầu đăng nhập đối với tất cả index, view trong mọi controller */
    }
}
