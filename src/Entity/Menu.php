<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuRepository")
 */
class Menu
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
    private $denomination;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="menu")
     */
    private $commandes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Plat", inversedBy="menus")
     */
    private $plat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PrixMenu", mappedBy="menu")
     */
    private $prixMenus;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->plat = new ArrayCollection();
        $this->prixMenus = new ArrayCollection();
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
            $commande->addMenu($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            $commande->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection|Plat[]
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plat->contains($plat)) {
            $this->plat[] = $plat;
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plat->contains($plat)) {
            $this->plat->removeElement($plat);
        }

        return $this;
    }

    /**
     * @return Collection|PrixMenu[]
     */
    public function getPrixMenus(): Collection
    {
        return $this->prixMenus;
    }

    public function addPrixMenu(PrixMenu $prixMenu): self
    {
        if (!$this->prixMenus->contains($prixMenu)) {
            $this->prixMenus[] = $prixMenu;
            $prixMenu->setMenu($this);
        }

        return $this;
    }

    public function removePrixMenu(PrixMenu $prixMenu): self
    {
        if ($this->prixMenus->contains($prixMenu)) {
            $this->prixMenus->removeElement($prixMenu);
            // set the owning side to null (unless already changed)
            if ($prixMenu->getMenu() === $this) {
                $prixMenu->setMenu(null);
            }
        }

        return $this;
    }
}
