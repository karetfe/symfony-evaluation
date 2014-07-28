<?php
namespace Acme\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Position
 * @ORM\Entity
 * @ORM\Table(name="positions")
 */
class Position {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="pid")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="position_name", type="string", length=80)
     */
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return Position
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
