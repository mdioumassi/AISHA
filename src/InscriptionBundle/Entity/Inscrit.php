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
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime",nullable=true)
     */
    private $createAt;


    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Enfant")
     * @ORM\JoinColumn(name="enfant_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $enfant;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Niveau")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $niveau;

    /**
     * Inscrit constructor.
     */
    public function __construct()
    {
        $this->setCreateAt(new \DateTime("now"));
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Inscrit
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Inscrit
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }
}
