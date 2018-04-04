<?php

namespace SoukBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="SoukBundle\Repository\ArticleRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
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
     * @ORM\Column(name="description", type="string",nullable=true,length=255,unique=true)
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
     * @Vich\UploadableField(mapping="images", fileNameProperty="image")
     * @var File
     * @Assert\Image()
     *
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;



    /**
     *
     * @ORM\OneToMany(targetEntity="SoukBundle\Entity\Ligne", mappedBy="article",cascade={"persist"})
     */
    protected $lignes;


    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetRegistrationDate()
    {
        $this->date_pub = new \DateTime();
    }



    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }


    public function getImageFile()
    {
        return $this->imageFile;
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

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignes = new ArrayCollection();
    }

    /**
     * Add lignes
     *
     * @param Ligne $ligne
     * @return Article
     */
    public function addUserRecipeAssociation(Ligne $ligne)
    {
        $this->lignes[] = $ligne;

        return $this;
    }

    /**
     * Remove lignes
     *
     * @param Ligne $ligne
     */
    public function removeUserRecipeAssociation(Ligne $ligne)
    {
        $this->lignes->removeElement($ligne);
    }

    /**
     * Get ligne
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserRecipeAssociations()
    {
        return $this->lignes;
    }


}

