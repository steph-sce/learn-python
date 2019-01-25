<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    const POST_TYPE_VIDEO = 'vidéo';
    const POST_TYPE_POST = 'post';

    const POST_OPEN = 'open';
    const POST_CLOSE = 'close';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="post", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="posts", cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $post_type;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="smallint")
     */
    private $duration;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $link_video;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->category->contains($category)) {
            $this->category->removeElement($category);
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPostType(): ?string
    {
        return $this->post_type;
    }

    public function setPostType(string $post_type): self
    {
        if (!in_array($post_type, array(self::POST_TYPE_VIDEO, self::POST_TYPE_POST))) {
            throw new \InvalidArgumentException("Invalid status");
        }

        $this->post_type = $post_type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, array(self::POST_OPEN, self::POST_CLOSE))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        
        $this->status = $status;

        return $this;
    }

    public function getLinkVideo(): ?string
    {
        return $this->link_video;
    }

    public function setLinkVideo(string $link_video): self
    {
        $this->link_video = $link_video;

        return $this;
    }
}
