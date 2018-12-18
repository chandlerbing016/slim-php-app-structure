<?php

namespace Kirk\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kirk\Entities\Post;

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
     * @ORM\Column(type="string", length=64)
     */
    protected $displayname;

    /**
     * @ORM\Column(type="string", length=224)
     */
    protected $email;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $data_joined;

    /**
     * One User can have many posts. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     */
    protected $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDisplayname(string $displayname)
    {
        $this->displayname = $displayname;
    }

    public function getDisplayName()
    {
        return $this->displayname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPost(Post $post)
    {
        if ($this->posts->contains($post)) {
            return;
        }

        $this->posts->add($post);
        $post->setUser($this);
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setJoiningDate()
    {
        $this->data_joined = new \DateTime();
    }

    public function getJoiningDate()
    {
        return $this->data_joined;
    }
}
