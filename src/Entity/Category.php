<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $children;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Post", mappedBy="category")
     */
    private $posts;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->posts    = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getParent(): ?Category
    {
        return $this->parent;
    }

    /**
     * @param Category|null $parent
     *
     * @return Category
     */
    public function setParent(?Category $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @param Category $child
     *
     * @return Category
     */
    public function addChild(Category $child): self
    {
        if (true === $this->children->contains($child)) {
            return $this;
        }

        $this->children[] = $child;
        $child->setParent($this);

        return $this;
    }

    /**
     * @param Category $child
     *
     * @return Category
     */
    public function removeChild(Category $child): self
    {
        if (false === $this->children->contains($child)) {
            return $this;
        }

        $this->children->removeElement($child);

        if ($child->getParent() === $this) {
            $child->setParent(null);
        }

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->addCategory($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            $post->removeCategory($this);
        }

        return $this;
    }
}
