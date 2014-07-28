<?php

namespace Acme\EvaluationBundle\Entity;

use Acme\EvaluationBundle\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{


    /**
     * @ORM\Column(type="integer", name="uid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *      min="5",
     *      minMessage="Your username must have at least 5 characters !"
     * )
     * @ORM\Column(type="string", length=30, unique=true)
     */
    protected $username;

    /**
     * @Assert\NotBlank(
     *      message = "Please enter a password"
     * )
     * @Assert\Length(
     *      min="6",
     *      minMessage="Your password must have at least 6 characters !"
     * )
     * @ORM\Column(type="string", length=40)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min="3",
     *      minMessage="Your name must have at least 3 characters !"
     * )
     */
    protected $name;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $status;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="roles_map",
     *     joinColumns={@ORM\JoinColumn(name="uid", referencedColumnName="uid")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="rid", referencedColumnName="rid")}
     * )
     */
    protected $roles;

    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="users_managers",
     *     joinColumns={@ORM\JoinColumn(name="uid", referencedColumnName="uid")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="mid", referencedColumnName="uid")}
     * )
     */
    protected $managers;



    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->managers = new ArrayCollection();
        $this->questions = new ArrayCollection();

    }


    public function getRoles()
    {
        return $this->roles->toArray();
    }

    public function getRole($role)
    {
        foreach ($this->getRoles() as $roleItem) {
            if ($role == $roleItem->getRole()) {
                return $roleItem;
            }
        }

        return null;
    }

    public function addRole($role)
    {
        if (!$role instanceof Role) {
            throw new \Exception("addRole takes a Role object as the parameter");
        }
        if ($this->getRole($role->getRole()) == null) {
            $this->roles->add($role);
        }
    }

    public function removeRole($role)
    {
        $roleElement = $this->getRole($role);
        if ($roleElement) {
            $this->roles->removeElement($roleElement);
        }
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function encrypt($password)
    {
        return sha1($password);
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add companies
     *
     * @param \Acme\EvaluationBundle\Entity\Company $companies
     * @return User
     */
    public function addCompany(\Acme\EvaluationBundle\Entity\Company $companies)
    {
        $this->companies[] = $companies;

        return $this;
    }

    /**
     * Remove companies
     *
     * @param \Acme\EvaluationBundle\Entity\Company $companies
     */
    public function removeCompany(\Acme\EvaluationBundle\Entity\Company $companies)
    {
        $this->companies->removeElement($companies);
    }

    /**
     * Get companies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * Add positions
     *
     * @param \Acme\EvaluationBundle\Entity\Position $positions
     * @return User
     */
    public function addPosition(\Acme\EvaluationBundle\Entity\Position $positions)
    {
        $this->positions[] = $positions;

        return $this;
    }

    /**
     * Remove positions
     *
     * @param \Acme\EvaluationBundle\Entity\Position $positions
     */
    public function removePosition(\Acme\EvaluationBundle\Entity\Position $positions)
    {
        $this->positions->removeElement($positions);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Add departments
     *
     * @param \Acme\EvaluationBundle\Entity\Department $departments
     * @return User
     */
    public function addDepartment(\Acme\EvaluationBundle\Entity\Department $departments)
    {
        $this->departments[] = $departments;

        return $this;
    }

    /**
     * Remove departments
     *
     * @param \Acme\EvaluationBundle\Entity\Department $departments
     */
    public function removeDepartment(\Acme\EvaluationBundle\Entity\Department $departments)
    {
        $this->departments->removeElement($departments);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Add managers
     *
     * @param \Acme\EvaluationBundle\Entity\User $managers
     * @return User
     */
    public function addManager(\Acme\EvaluationBundle\Entity\User $managers)
    {
        $this->managers[] = $managers;

        return $this;
    }

    /**
     * Remove managers
     *
     * @param \Acme\EvaluationBundle\Entity\User $managers
     */
    public function removeManager(\Acme\EvaluationBundle\Entity\User $managers)
    {
        $this->managers->removeElement($managers);
    }

    /**
     * Get managers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManagers()
    {
        return $this->managers;
    }
}
