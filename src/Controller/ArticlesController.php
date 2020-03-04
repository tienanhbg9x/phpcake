<?php

namespace App\Controller;

use App\Controller\AppController;


class ArticlesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['categories'],
        ];
        $articles = $this->paginate($this->Articles);

        $this->set(compact('articles'));
    }

    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['categories'],
        ]);

        $this->set('article', $article);
    }

    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories'));
    }

    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $categories = $this->Articles->categories->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        if (in_array($this->request->getParam('action'), ['edit', 'delete'])) {
            $articleId = (int)$this->request->getParam('pass.0');
            if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
