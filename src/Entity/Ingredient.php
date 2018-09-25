<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientRepository")
 */
class Ingredient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $denomination;

    /**
     * @ORM\Column(type="float")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $seuil_alerte;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrixIngredient", mappedBy="ingredient")
     */
    private $prixIngredients;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeIngredient", inversedBy="ingredient")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeIngredient;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IngredientPlat", mappedBy="ingredient")
     */
    private $ingredientPlats;

    public function __construct()
    {
        $this->prixIngredients = new ArrayCollection();
        $this->ingredientPlats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDenomination(): ?string
    {
        return $this->denomination;
    }

    public function setDenomination(string $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getSeuilAlerte(): ?int
    {
        return $this->seuil_alerte;
    }

    public function setSeuilAlerte(int $seuil_alerte): self
    {
        $this->seuil_alerte = $seuil_alerte;

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

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return Collection|PrixIngredient[]
     */
    public function getPrixIngredients(): Collection
    {
        return $this->prixIngredients;
    }

    public function addPrixIngredient(PrixIngredient $prixIngredient): self
    {
        if (!$this->prixIngredients->contains($prixIngredient)) {
            $this->prixIngredients[] = $prixIngredient;
            $prixIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removePrixIngredient(PrixIngredient $prixIngredient): self
    {
        if ($this->prixIngredients->contains($prixIngredient)) {
            $this->prixIngredients->removeElement($prixIngredient);
            // set the owning side to null (unless already changed)
            if ($prixIngredient->getIngredient() === $this) {
                $prixIngredient->setIngredient(null);
            }
        }

        return $this;
    }

    public function getTypeIngredient(): ?TypeIngredient
    {
        return $this->typeIngredient;
    }

    public function setTypeIngredient(?TypeIngredient $typeIngredient): self
    {
        $this->typeIngredient = $typeIngredient;

        return $this;
    }

    /**
     * @return Collection|IngredientPlat[]
     */
    public function getIngredientPlats(): Collection
    {
        return $this->ingredientPlats;
    }

    public function addIngredientPlat(IngredientPlat $ingredientPlat): self
    {
        if (!$this->ingredientPlats->contains($ingredientPlat)) {
            $this->ingredientPlats[] = $ingredientPlat;
            $ingredientPlat->setIngredient($this);
        }

        return $this;
    }

    public function removeIngredientPlat(IngredientPlat $ingredientPlat): self
    {
        if ($this->ingredientPlats->contains($ingredientPlat)) {
            $this->ingredientPlats->removeElement($ingredientPlat);
            // set the owning side to null (unless already changed)
            if ($ingredientPlat->getIngredient() === $this) {
                $ingredientPlat->setIngredient(null);
            }
        }

        return $this;
    }
}
