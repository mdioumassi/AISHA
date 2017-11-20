<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * Niveau
 *
 * @ORM\Table(name="niveaux")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\NiveauRepository")
 * @UniqueEntity(fields={"classe"}, message="Cette classe est déjà enregistrée")
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
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(name="mensualite", type="integer")
     */
    private $mensualite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="InscriptionBundle\Entity\Matiere", mappedBy="niveau", cascade={"persist","remove"})
     *
     */
    private $matieres;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matieres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setCreatedAt(new \DateTime("now"));
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
     * Set classe
     *
     * @param string $classe
     *
     * @return Niveau
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
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
     * Set mensualite
     *
     * @param integer $mensualite
     *
     * @return Niveau
     */
    public function setMensualite($mensualite)
    {
        $this->mensualite = $mensualite;

        return $this;
    }

    /**
     * Get mensualite
     *
     * @return integer
     */
    public function getMensualite()
    {
        return $this->mensualite;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Niveau
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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

    public function __toString()
    {
        return $this->classe;
    }
}
