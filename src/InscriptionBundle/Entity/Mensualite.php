<?php

namespace InscriptionBundle\Entity;

use InscriptionBundle\Entity\Traits\CreatedAtTrait;
use InscriptionBundle\Entity\Traits\UpdatedAtTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * MensualiteNiveau
 *
 * @ORM\Table(name="mensualite")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\MensualiteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Mensualite
{
    use CreatedAtTrait;
    use UpdatedAtTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="mois", type="string", length=25)
     */
    private $mois;
    /**
     * @var bool
     *
     * @ORM\Column(name="paye", type="boolean")
     */
    private $paye;

    /**
     * @ORM\Column(name="commentaire", type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Enfant")
     * @ORM\JoinColumn(name="enfant_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Niveau")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $niveau;


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
     * Set mois
     *
     * @param string $mois
     *
     * @return Mensualite
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set paye
     *
     * @param boolean $paye
     *
     * @return Mensualite
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
     * Set enfant
     *
     * @param \InscriptionBundle\Entity\Enfant $enfant
     *
     * @return Mensualite
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
     * @return Mensualite
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

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Mensualite
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function __toString()
    {
        if (is_null($this->mois)) {
            return 'NULL';
        }
        return $this->mois;
    }
}
