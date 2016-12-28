<?php
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="item")
 */
class Item
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=32, unique=true, nullable=false)
     */
    protected $Name;
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->Name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}