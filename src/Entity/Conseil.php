<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConseilRepository")
 */
class Conseil
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique = True)
     * @Assert\NotBlank(message="Ce champs ne doit pas être vide")
     * @Assert\Length(
     *      min = 3,
     *      max = 30,
     *      exactMessage = "Ce champs ne doit pas contenir moins de 3 ou plus 30 caracteres",)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Ce champs ne doit pas être vide")
     * @Assert\Length(
     *      min = 3,
     *      max = 1000,
     *      exactMessage = "Ce champs ne doit pas contenir moins de 3 ou plus 10000 caracteres",)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ccategorie", inversedBy="conseils")
     */
    private $ccategorie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="conseils")
     */
    private $createdBy;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCcategorie(): ?Ccategorie
    {
        return $this->ccategorie;
    }

    public function setCcategorie(?Ccategorie $ccategorie): self
    {
        $this->ccategorie = $ccategorie;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
