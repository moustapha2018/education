<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CcategorieRepository")
 */
class Ccategorie
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
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ccategories")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conseil", mappedBy="ccategorie")
     */
    private $conseils;

    public function __construct()
    {
        $this->conseils = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|Conseil[]
     */
    public function getConseils(): Collection
    {
        return $this->conseils;
    }

    public function addConseil(Conseil $conseil): self
    {
        if (!$this->conseils->contains($conseil)) {
            $this->conseils[] = $conseil;
            $conseil->setCcategorie($this);
        }

        return $this;
    }

    public function removeConseil(Conseil $conseil): self
    {
        if ($this->conseils->contains($conseil)) {
            $this->conseils->removeElement($conseil);
            // set the owning side to null (unless already changed)
            if ($conseil->getCcategorie() === $this) {
                $conseil->setCcategorie(null);
            }
        }

        return $this;
    }
}
