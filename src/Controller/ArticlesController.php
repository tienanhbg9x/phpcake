<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\ArticlesTable;

class ArticlesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash');
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        $articles = $this->Paginator->paginate($this->Articles->find('all'));
        $this->set(compact('articles'));
    }

    public function view($id = null)
    {
        $articles = $this->Articles->get($id);
        $this->set(compact('articles'));
    }

    public function add()
    {
        $articles = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $articles = $this->Articles->pathEntity($articles, $this->request->getData());
            if ($this->Articles->save($articles)) {
                $this->Flash->success(__('article has been saved'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $articles);
    }

    public function edit($id = null)
    {
        $articles = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->pathEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('your article has been updated'));
            }
            $this->Flash->error(__('updated fail'));
        }
        $this->set('article', $articles);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post' => 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('article with id:{0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
}
