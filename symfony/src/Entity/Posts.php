<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostsRepository::class)
 */
class Posts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="post_author",type="integer",  nullable=false, options={"default": "0"})
     */
    private $postAuthor;

    /**
     * @ORM\Column(name="post_content", type="text",  nullable=false, options={"default": ""})
     */
    private $postContent;

    /**
     * @ORM\Column(name="post_title", type="string",length=64, nullable=false, options={"default": ""})
     */
    private $postTitle;

    /**
     * @ORM\Column(name="post_status", type="string",length=16, nullable=false, options={"default": "darft"})
     */
    private $postStatus;

    /**
     * @ORM\Column(name="post_excerpt", type="string",length=255, nullable=false, options={"default": ""})
     */
    private $postExcerpt;

    /**
     * @ORM\Column(name="post_thumb", type="string", length=150, nullable=false, options={"default": ""})
     */
    private $postThumb;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"default": "CURRENT_TIMESTAMP"})
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostAuthor(): ?string
    {
        return $this->postAuthor;
    }

    public function setPostAuthor(string $postAuthor): self
    {
        $this->postAuthor = $postAuthor;

        return $this;
    }

    public function getPostContent(): ?string
    {
        return $this->postContent;
    }

    public function setPostExcerpt(string $postExcerpt): self
    {
        $this->postExcerpt = $postExcerpt;

        return $this;
    }

    public function getPostExcerpt(): ?string
    {
        return $this->postExcerpt;
    }

    public function setPostContent(string $postContent): self
    {
        $this->postContent = $postContent;

        return $this;
    }

    public function getPostTitle(): ?string
    {
        return $this->postTitle;
    }

    public function setPostTitle(string $postTitle): self
    {
        $this->postTitle = $postTitle;

        return $this;
    }

    public function getPostStatus(): ?string
    {
        return $this->postStatus;
    }

    public function setPostThumb(string $postThumb): self
    {
        $this->postThumb = $postThumb;

        return $this;
    }

    public function getPostThumb(): ?string
    {
        return $this->postThumb;
    }

    public function setPostStatus(string $postStatus): self
    {
        $this->postStatus = $postStatus;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
