<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rcategorie", mappedBy="createdBy")
     */
    private $rcategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recette", mappedBy="createdBy")
     */
    private $recettes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ccategorie", mappedBy="createdBy")
     */
    private $ccategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conseil", mappedBy="createdBy")
     */
    private $conseils;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Astuce", mappedBy="createdBy")
     */
    private $astuces;






    public function __construct()
    {
        $this->rcategories = new ArrayCollection();
        $this->recettes = new ArrayCollection();
        $this->ccategories = new ArrayCollection();
        $this->conseils = new ArrayCollection();
        $this->astuces = new ArrayCollection();
        

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Rcategorie[]
     */
    public function getRcategories(): Collection
    {
        return $this->rcategories;
    }

    public function addRcategory(Rcategorie $rcategory): self
    {
        if (!$this->rcategories->contains($rcategory)) {
            $this->rcategories[] = $rcategory;
            $rcategory->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRcategory(Rcategorie $rcategory): self
    {
        if ($this->rcategories->contains($rcategory)) {
            $this->rcategories->removeElement($rcategory);
            // set the owning side to null (unless already changed)
            if ($rcategory->getCreatedBy() === $this) {
                $rcategory->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRecettes(): Collection
    {
        return $this->recettes;
    }

    public function addRecette(Recette $recette): self
    {
        if (!$this->recettes->contains($recette)) {
            $this->recettes[] = $recette;
            $recette->setCreatedBy($this);
        }

        return $this;
    }

    public function removeRecette(Recette $recette): self
    {
        if ($this->recettes->contains($recette)) {
            $this->recettes->removeElement($recette);
            // set the owning side to null (unless already changed)
            if ($recette->getCreatedBy() === $this) {
                $recette->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ccategorie[]
     */
    public function getCcategories(): Collection
    {
        return $this->ccategories;
    }

    public function addCcategory(Ccategorie $ccategory): self
    {
        if (!$this->ccategories->contains($ccategory)) {
            $this->ccategories[] = $ccategory;
            $ccategory->setCreatedBy($this);
        }

        return $this;
    }

    public function removeCcategory(Ccategorie $ccategory): self
    {
        if ($this->ccategories->contains($ccategory)) {
            $this->ccategories->removeElement($ccategory);
            // set the owning side to null (unless already changed)
            if ($ccategory->getCreatedBy() === $this) {
                $ccategory->setCreatedBy(null);
            }
        }

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
            $conseil->setCreatedBy($this);
        }

        return $this;
    }

    public function removeConseil(Conseil $conseil): self
    {
        if ($this->conseils->contains($conseil)) {
            $this->conseils->removeElement($conseil);
            // set the owning side to null (unless already changed)
            if ($conseil->getCreatedBy() === $this) {
                $conseil->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Astuce[]
     */
    public function getAstuces(): Collection
    {
        return $this->astuces;
    }

    public function addAstuce(Astuce $astuce): self
    {
        if (!$this->astuces->contains($astuce)) {
            $this->astuces[] = $astuce;
            $astuce->setCreatedBy($this);
        }

        return $this;
    }

    public function removeAstuce(Astuce $astuce): self
    {
        if ($this->astuces->contains($astuce)) {
            $this->astuces->removeElement($astuce);
            // set the owning side to null (unless already changed)
            if ($astuce->getCreatedBy() === $this) {
                $astuce->setCreatedBy(null);
            }
        }

        return $this;
    }




}
