<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;
    private $file;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePosted;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $category;

    /**
     * Post constructor.
     * @param $id
     * @param $title
     * @param $content
     * @param $image
     * @param $datePosted
     * @param $category
     */
    public function __construct()
    {
        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDatePosted(): ?\DateTimeInterface
    {
        return $this->datePosted;
    }

    public function setDatePosted(\DateTimeInterface $datePosted): self
    {
        $this->datePosted = $datePosted;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = NULL): self
    {
        $this->file = $file;
        return $this;
    }

    public function uploadFile()
    {
        $name = $this->file->getClientOriginalName();
        $new_name = 'photo_' . time() . '_' . rand(1, 9999) . '_' . $name;
        $dirPhoto = __DIR__ . '/../../public/photo/';
        $this->file->move($dirPhoto, $new_name);
        $this->image = $new_name;
    }

    public function deleteFile()
    {
        if(file_exists(__DIR__ . '/../../public/photo' . $this->image)) {
            unlink(__DIR__ . '/../../public/photo' . $this->image);
        }
    }
}
