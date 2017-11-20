<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;


/**
 * Matiere
 *
 * @ORM\Table(name="matieres")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\MatiereRepository")
 * @UniqueEntity(fields={"libelle"}, message="Ce libelle est déjà enregistré")
 */
class Matiere
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="coefficient", type="integer")
     */
    private $coefficient;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Niveau", inversedBy="matieres")
     */
    private $niveau;

    /**
     * Matiere constructor.
     * @param Niveau|null $niveau
     */
    public function __construct(Niveau $niveau = null)
    {
        $this->niveau = $niveau;
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Matiere
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Matiere
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
     * Set coefficient
     *
     * @param integer $coefficient
     *
     * @return Matiere
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set niveau
     *
     * @param \InscriptionBundle\Entity\Niveau $niveau
     *
     * @return Matiere
     */
    public function setNiveau(\InscriptionBundle\Entity\Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \InscriptionBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }
}
