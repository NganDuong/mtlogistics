<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
* 
*/
class ProductPhoto extends Entity {
	
	protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}