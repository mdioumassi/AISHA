<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveaux")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="InscriptionBundle\Entity\Enfant", cascade={"persist","remove"}, mappedBy="niveau")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enfants;

    /**
     * @ORM\ManyToMany(targetEntity="InscriptionBundle\Entity\Matiere", cascade={"persist"}, inversedBy="niveaux")
     */
    private $matieres;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->matieres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Niveau
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Niveau
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add enfant
     *
     * @param \InscriptionBundle\Entity\Enfant $enfant
     *
     * @return Niveau
     */
    public function addEnfant(\InscriptionBundle\Entity\Enfant $enfant)
    {
        $this->enfants[] = $enfant;

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \InscriptionBundle\Entity\Enfant $enfant
     */
    public function removeEnfant(\InscriptionBundle\Entity\Enfant $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Add matiere
     *
     * @param \InscriptionBundle\Entity\Matiere $matiere
     *
     * @return Niveau
     */
    public function addMatiere(\InscriptionBundle\Entity\Matiere $matiere)
    {
        $this->matieres[] = $matiere;

        return $this;
    }

    /**
     * Remove matiere
     *
     * @param \InscriptionBundle\Entity\Matiere $matiere
     */
    public function removeMatiere(\InscriptionBundle\Entity\Matiere $matiere)
    {
        $this->matieres->removeElement($matiere);
    }

    /**
     * Get matieres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatieres()
    {
        return $this->matieres;
    }
}
