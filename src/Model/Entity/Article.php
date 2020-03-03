<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Article extends Entity
{
    protected $_accessible = [
      'title' => true,
      'body' => true,
      'category_id' => true,
      'created' => true,
      'modified' => true,
    ];
}
