<?php
namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity(repositoryClass="Repositories\ItemRepository")
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
     * @Column(type="string", length=32, unique=false, nullable=true)
     */
    protected $Name;

    /**
     * @Column(type="string", length=32, unique=false, nullable=true)
     */
    protected $Detail;

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

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->Detail;
    }

    /**
     * @param mixed $Detail
     */
    public function setDetail($Detail)
    {
        $this->Detail = $Detail;
    }

}