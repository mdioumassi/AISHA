<?php

namespace InscriptionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;


/**
 * Parent
 *
 * @ORM\Table(name="parents")
 * @ORM\Entity(repositoryClass="InscriptionBundle\Repository\ParentRepository")
 * @UniqueEntity(fields={"nom","prenom"}, message="Ce parent est déjà enregistré")
 */
class Parents
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
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=30)
     * @Assert\Choice({"Homme", "Femme"})
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $fonction;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     * @Assert\NotBlank()
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="addresse", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $addresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime",nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="InscriptionBundle\Entity\Enfant", cascade="all", orphanRemoval=true, mappedBy="parent")
     * @ORM\JoinColumn(nullable=false)
     * @var Enfant[]
     */
    private $enfants;
    /**
     * Constructor
     */
    public function __construct()
    {
       $this->enfants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Parents
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
     * @return Parents
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
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Parents
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Parents
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Parents
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set addresse
     *
     * @param string $addresse
     *
     * @return Parents
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * Get addresse
     *
     * @return string
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Parents
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
     * Add enfant
     *
     * @param \InscriptionBundle\Entity\Enfant $enfant
     *
     * @return Parents
     */
    public function addEnfant(\InscriptionBundle\Entity\Enfant $enfant)
    {
        $this->enfants[] = $enfant;
        $enfant->setParent($this);

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

    public function __toString()
    {
        return $this->getNom();
    }

}
