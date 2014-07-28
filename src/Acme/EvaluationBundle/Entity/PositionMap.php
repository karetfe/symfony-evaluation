<?php
namespace Acme\EvaluationBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="positions_map")
 */
class PositionMap {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="map_id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     * @ORM\JoinColumn(name="uid", referencedColumnName="uid")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="id")
     * @ORM\JoinColumn(name="cid", referencedColumnName="cid")
     */
    protected $company;

    /**
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="id")
     * @ORM\JoinColumn(name="did", referencedColumnName="did")
     */
    protected $department;

    /**
     * @ORM\ManyToOne(targetEntity="Position", inversedBy="id")
     * @ORM\JoinColumn(name="pid", referencedColumnName="pid")
     */
    protected $position;
}