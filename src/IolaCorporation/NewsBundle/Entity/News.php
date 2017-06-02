<?php

namespace IolaCorporation\NewsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use IolaCorporation\NewsBundle\Entity\Album;
use Doctrine\ORM\Mapping as ORM;
use Ropi\AuthenticationBundle\Entity\IdentifiantWeb;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="IolaCorporation\NewsBundle\Repository\NewsRepository")
 */
class News
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="news", type="text", nullable=true)
     */
    private $news;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Ropi\AuthenticationBundle\Entity\IdentifiantWeb", inversedBy="news",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ecriture", type="datetime")
     */
    private $dateEcriture;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="datetime")
     */
    private $datePublication;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;



    /**
     * News constructor.
     * @param \DateTime $datePublication
     */

    /**
     *
     *     **
     * @var File
     *
     * @ORM\ManyToMany(targetEntity="Album", mappedBy="news", cascade={"persist"})
     *
     */
    private $album;


    public function __construct()
    {
        $this->album = new ArrayCollection();

        $this->datePublication = new \Datetime();

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
     * Set titre
     *
     * @param string $titre
     *
     * @return News
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set news
     *
     * @param string $news
     *
     * @return News
     */
    public function setNews($news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return string
     */
    public function getNews()
    {
        return $this->news;
    }



    /**
     * Set dateEcriture
     *
     * @param \DateTime $dateEcriture
     *
     * @return News
     */
    public function setDateEcriture($dateEcriture)
    {
        $this->dateEcriture = $dateEcriture;

        return $this;
    }

    /**
     * Get dateEcriture
     *
     * @return \DateTime
     */
    public function getDateEcriture()
    {
        return $this->dateEcriture;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return News
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     *
     * @return News
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }



    public function getAlbum(){
        return $this->album;
    }
  /*  public function setAlbum($album){
        $this->album = $album;
    }
*/
    function __toString()
    {
      return $this->titre;
    }




    /**
     * Add album
     *
     * @param \IolaCorporation\NewsBundle\Entity\Album $album
     *
     * @return News
     */
    public function addAlbum(\IolaCorporation\NewsBundle\Entity\Album $album)
    {
        $album->addNews($this);

        $this->album->add($album);

        return $this;
    }

    /**
     * Remove album
     *
     * @param \IolaCorporation\NewsBundle\Entity\Album $album
     */
    public function removeAlbum(\IolaCorporation\NewsBundle\Entity\Album $album)
    {
        $this->album->removeElement($album);
    }

    /**
     * Set user
     *
     * @param Ropi\AuthenticationBundle\Entity\IdentifiantWeb
     *
     * @return News
     */
    public function setUser(IdentifiantWeb $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return Ropi\AuthenticationBundle\Entity\IdentifiantWeb
     */
    public function getUser()
    {
        return $this->user;
    }
}
