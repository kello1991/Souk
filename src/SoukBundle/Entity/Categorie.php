<?php

namespace SoukBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="SoukBundle\Repository\CategorieRepository")
 * @Vich\Uploadable
 *
 */
class Categorie
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
     * @ORM\Column(name="nom", type="string",nullable=true,length=255)
     */
    private $nom;


    /**
     * @var string
     * @ORM\Column(name="description", type="string",nullable=true,length=255)
     */
    private $description;

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

    public function __toString()
    {
       return $this->getNom();
    }


}

