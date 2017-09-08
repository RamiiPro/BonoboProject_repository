<?php
// src/Bonobo/BonoboBundle/Entity/User.php

namespace Bonobo\BonoboBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Bonobo\BonoboBundle\Entity\Friend", cascade={"persist"})
     *   
     */

    private $friends;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



    /**
     * Add friend
     *
     * @param \Bonobo\BonoboBundle\Entity\Friend $friend
     *
     * @return User
     */
    public function addFriend(\Bonobo\BonoboBundle\Entity\Friend $friend)
    {
        $this->friends[] = $friend;

        return $this;
    }

    /**
     * Remove friend
     *
     * @param \Bonobo\BonoboBundle\Entity\Friend $friend
     */
    public function removeFriend(\Bonobo\BonoboBundle\Entity\Friend $friend)
    {
        $this->friends->removeElement($friend);
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friends;
    }
}
