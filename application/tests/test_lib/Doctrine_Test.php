<?php
require_once(__DIR__.'/../CITestCase.php');
class Doctrine_Test extends CITestCase
{

    /**
     * Test chức năng doctrine trong source
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function test_doctrine(){
        return false;
        $item= new Entity\Item;
        //$item->getAllItemArrays();
        $item->setName("son123");
        $item->setDetail("NoiDung");
        $this->CI->em->persist($item);
        $this->CI->em->flush();
        $this->CI->em->getRepository("Entity\Item")->getAllItemArrays();
        /** @var Entity\Item $entity */
        $entity = $this->CI->em->find("Entity\Item",1);
        $entity->setName("sondeptrai");
        $this->CI->em->persist($entity);
        $this->CI->em->flush();

        $this->CI->em->remove($entity);
        // Delete entity
        //$this->em->flush();
    }
}

