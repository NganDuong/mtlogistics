<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
* 
*/
class AdminUser extends Entity {
	
	protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}