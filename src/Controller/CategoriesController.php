<?php

namespace App\Controller;

use App\Controller\AppController;

class CategoriesController extends AppController
{
    public function index()
    {
        $categories = $this->Categories->find()
            ->order(['lft' => 'ASC']);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

    public function view($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => ['ParentCategories', 'Articles', 'ChildCategories'],
        ]);

        $this->set('category', $category);
    }

    public function add()
    {
        $category = $this->Categories->newEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    public function edit($id = null)
    {
        $category = $this->Categories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $this->Flash->success(__('The category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The category could not be saved. Please, try again.'));
        }
        $parentCategories = $this->Categories->ParentCategories->find('list', ['limit' => 200]);
        $this->set(compact('category', 'parentCategories'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('The category has been deleted.'));
        } else {
            $this->Flash->error(__('The category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function moveUp($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveUp($category)) {
            $this->Flash->success('the category has been moved up');
        } else {
            $this->Flash->error('could not be moved up.Please, try again');
        }
        return $this->redirect(['action' => 'index']);
    }
    public function moveDown($id = null)
    {
        $this->request->allowMethod(['post', 'put']);
        $category = $this->Categories->get($id);
        if ($this->Categories->moveDown($category)) {
            $this->Flash->success('the category has been moved down');
        } else {
            $this->Flash->error('could not be moved down.Please, try again');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }
}
