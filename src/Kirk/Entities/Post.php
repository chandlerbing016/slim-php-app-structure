<?php

namespace Kirk\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kirk\Entities\User;
use Kirk\Entities\Tag;

/**
 * @ORM\Entity
 * @ORM\Table(name="kk_post")
 */
class Post
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
    protected $date_added;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Many posts can have many tags. This is the owning side.
     * @ORM\ManytoMany(targetEntity="Tag", inversedBy="posts", indexBy="name", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *  name="kk_post_tag"
     * )
     */
    protected $tags;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date_updated;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->date_updated = new \DateTime();
        $this->date_added = new \DateTime();
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }

    public function setLastUpdatedDate()
    {
        $this->date_updated = new \DateTime();
    }

    public function getLastUpdatedDate()
    {
        return $this->date_updated;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function setUser(User $user)
    {
        if (isset($this->user)) {
            return;
        }
        $this->user = $user;
        $user->setPost($this);
    }

    public function setTag(Tag $tag)
    {
        if($this->tags->contains($tag)) {
            return;
        }
        $this->tags->add($tag);
        $tag->setPost($this);
    }
}
