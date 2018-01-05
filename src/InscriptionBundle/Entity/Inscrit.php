<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscrit
 *
 * @ORM\Table(name="inscrit")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\InscritRepository")
 */
class Inscrit
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
     * @ORM\Column(name="frais", type="integer")
     */
    private $frais;

    /**
     * @ORM\Column(name="paye", type="boolean", nullable=true)
     */
    private $paye;

    /**
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Enfant")
     * @ORM\JoinColumn(name="enfant_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Niveau", cascade="all")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $niveau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * Inscrit constructor.
     */
    public function __construct()
    {
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
     * Set frais
     *
     * @param integer $frais
     *
     * @return Inscrit
     */
    public function setFrais($frais)
    {
        $this->frais = $frais;

        return $this;
    }

    /**
     * Get frais
     *
     * @return integer
     */
    public function getFrais()
    {
        return $this->frais;
    }

    /**
     * Set paye
     *
     * @param boolean $paye
     *
     * @return Inscrit
     */
    public function setPaye($paye)
    {
        $this->paye = $paye;

        return $this;
    }

    /**
     * Get paye
     *
     * @return boolean
     */
    public function getPaye()
    {
        return $this->paye;
    }

    /**
     * Set annee
     *
     * @param integer $annee
     *
     * @return Inscrit
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Inscrit
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
     * Set enfant
     *
     * @param \InscriptionBundle\Entity\Enfant $enfant
     *
     * @return Inscrit
     */
    public function setEnfant(\InscriptionBundle\Entity\Enfant $enfant = null)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return \InscriptionBundle\Entity\Enfant
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * Set niveau
     *
     * @param \InscriptionBundle\Entity\Niveau $niveau
     *
     * @return Inscrit
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
