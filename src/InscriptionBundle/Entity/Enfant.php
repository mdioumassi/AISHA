<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * Enfant
 *
 * @ORM\Table(name="enfants")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\EnfantRepository")
 * @UniqueEntity(fields={"prenom"}, message="Cet enfant est déjà enregistré")
 * @ORM\HasLifecycleCallbacks()
 */
class Enfant
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
     * @Assert\NotBlank()
     * @Assert\Length(min="4")
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="4")
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="datetime")
     *
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=35)
     * @Assert\Choice({"Garçon", "Fille"})
     */
    private $genre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime",nullable=true)
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="InscriptionBundle\Entity\Parents", inversedBy="enfants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parent;

    /**
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;
    
    public function  __construct()
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Enfant
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Enfant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set genre
     *
     * @param string $genre
     *
     * @return Enfant
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Enfant
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

    /**
     * Set parent
     *
     * @param \InscriptionBundle\Entity\Parents $parent
     *
     * @return Enfant
     */
    public function setParent(\InscriptionBundle\Entity\Parents $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \InscriptionBundle\Entity\Parents
     */
    public function getParent()
    {
        return $this->parent;
    }
}
