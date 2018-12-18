<?php
namespace Kirk\Entities;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Kirk\Entities\Post;

/**
 * @ORM\Entity
 * @ORM\Table(name="kk_tag")
 */
class Tag
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
    protected $name;

    /**
     * Many tags can belong to many different posts. This is the inverse side
     * @ORM\ManytoMany(targetEntity="Post", mappedBy="tags")
     */
    protected $posts;

    /**
     * @ORM\Column(name="counter", type="integer")
     */
    protected $counter;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPost(Post $post)
    {
        if($this->posts->contains($post)) {
            return;
        }
        $this->posts->add($post);
        $post->setTag($this);
    }

}
