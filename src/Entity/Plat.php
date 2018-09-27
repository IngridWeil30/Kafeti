<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlatRepository")
 */
class Plat
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
    private $denomination;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrixPlat", mappedBy="plat")
     */
    private $prixPlats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IngredientPlat", mappedBy="plat")
     */
    private $ingredientPlats;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoriePlat", inversedBy="plat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoriePlat;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="plat")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Menu", mappedBy="plat")
     */
    private $menus;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    public function __construct()
    {
        $this->prixPlats = new ArrayCollection();
        $this->ingredientPlats = new ArrayCollection();
        $this->commandes = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
     * @return Collection|PrixPlat[]
     */
    public function getPrixPlats(): Collection
    {
        return $this->prixPlats;
    }

    public function addPrixPlat(PrixPlat $prixPlat): self
    {
        if (!$this->prixPlats->contains($prixPlat)) {
            $this->prixPlats[] = $prixPlat;
            $prixPlat->setPlat($this);
        }

        return $this;
    }

    public function removePrixPlat(PrixPlat $prixPlat): self
    {
        if ($this->prixPlats->contains($prixPlat)) {
            $this->prixPlats->removeElement($prixPlat);
            // set the owning side to null (unless already changed)
            if ($prixPlat->getPlat() === $this) {
                $prixPlat->setPlat(null);
            }
        }

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
            $ingredientPlat->setPlat($this);
        }

        return $this;
    }

    public function removeIngredientPlat(IngredientPlat $ingredientPlat): self
    {
        if ($this->ingredientPlats->contains($ingredientPlat)) {
            $this->ingredientPlats->removeElement($ingredientPlat);
            // set the owning side to null (unless already changed)
            if ($ingredientPlat->getPlat() === $this) {
                $ingredientPlat->setPlat(null);
            }
        }

        return $this;
    }

    public function getCategoriePlat(): ?CategoriePlat
    {
        return $this->categoriePlat;
    }

    public function setCategoriePlat(?CategoriePlat $categoriePlat): self
    {
        $this->categoriePlat = $categoriePlat;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addPlat($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removePlat($this);
        }

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->addPlat($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->contains($menu)) {
            $this->menus->removeElement($menu);
            $menu->removePlat($this);
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
