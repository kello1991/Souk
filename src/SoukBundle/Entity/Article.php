<?php

namespace SoukBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="SoukBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Article
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
     * @var Categorie
     * @ORM\ManyToOne(targetEntity="SoukBundle\Entity\Categorie")
     * @ORM\JoinColumn(name="categorie", referencedColumnName="id")
     */
    private $categorie;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string" , nullable=true , length=255)
     */
    private $nom;

    /**
     * @var string
     * @ORM\Column(name="description", type="string",nullable=true,length=255)
     */
    private $description;
    /**
     * @var float
     * @ORM\Column(name="prix", type="float",nullable=true)
     */
    private $prix;

    /**
     * @var DateTime
     * @ORM\Column(name="date_pub", type="datetime",nullable=true)
     */
    private $date_pub;

    /**
     * @var string
     * @ORM\Column(name="image", type="string",nullable=true,length=255)
     */
    private $image;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetRegistrationDate()
    {
        $this->date_pub = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return DateTime
     */
    public function getDatePub()
    {
        return $this->date_pub;
    }

    /**
     * @param DateTime $date_pub
     */
    public function setDatePub($date_pub)
    {
        $this->date_pub = $date_pub;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }




}

