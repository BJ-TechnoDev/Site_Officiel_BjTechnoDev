<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository", repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_bg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_rond;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getImgBg(): ?string
    {
        return $this->img_bg;
    }

    public function setImgBg(string $img_bg): self
    {
        $this->img_bg = $img_bg;

        return $this;
    }

    public function getImgRond(): ?string
    {
        return $this->img_rond;
    }

    public function setImgRond(string $img_rond): self
    {
        $this->img_rond = $img_rond;

        return $this;
    }

}
