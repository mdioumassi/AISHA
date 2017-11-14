<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MensualiteNiveau
 *
 * @ORM\Table(name="mensualite")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\MensualiteEnfantRepository")
 */
class Mensualite
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Enfant", inversedBy="mensualites")
     */
    private $enfant;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Mensualite
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Mensualite
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
}
