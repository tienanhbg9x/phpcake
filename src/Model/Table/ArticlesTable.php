<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
        $this->belongsTo('categories', [
           'foreignKey' => 'category_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title')
            ->requirePresence('title')
            ->notEmpty('body')
            ->requirePresence('body');

        return $validator;
    }

    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists([
           'id' => $articleId,
            'user_id' => $userId
        ]);
    }
}

