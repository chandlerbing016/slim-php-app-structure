<?php

namespace Kirk\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="kk_user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */

    protected $title;
    /**
     * @ORM\Column(type="text")
     */

    protected $content;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $data_joined;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date_added = new \DateTime();
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
}
