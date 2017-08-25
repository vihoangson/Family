<?php

namespace Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ItemRepository extends EntityRepository {

    public function getAllItemArrays() {
        return 123;
    }

    public function getItemArrayById($id) {
    }
}
