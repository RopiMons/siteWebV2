<?php

namespace IolaCorporation\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use IolaCorporation\NewsBundle\Entity\File;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="IolaCorporation\NewsBundle\Repository\AlbumRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Album
{
    private $temp;
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="stockage", type="string", length=255)
     * @Assert\NotBlank
     */
    private $stockage;
    /**
     *
     *     **
     * @var File
     *
     * @ORM\OneToMany(targetEntity="File", mappedBy="document", cascade={"persist", "remove"})
     *
     */
    private $files;

    /**
     * @ORM\ManyToMany(targetEntity="News", inversedBy="album")
     *
     **/
    private $news;



/**
* @var ArrayCollection
*/
    private $uploadedFiles;

    /**
     * Album constructor.
     */
    public function __construct()
    {
        $this->news = new ArrayCollection();
        $this->files = new ArrayCollection();
        $this->temp = new ArrayCollection();
        $this->stockage = "uploads/documents";
    }

    public function getUploadedFiles(){
        return $this->uploadedFiles;
    }
    public function setUploadedFiles($file){
        $this->uploadedFiles = $file;
    }

    public function setStockage($lieux){
    $this->stockage = $lieux;
}
    public function getStockage (){
        return $this->stockage;
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
     * Set name
     *
     * @param string $name
     *
     * @return Album
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setNews($news){
        $this->news = $news;
    }
    public  function getNews(){
        return $this->news;
    }


    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFiles()
    {
        return $this->files;
    }
    public function setFiles($file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (is_file($this->getAbsolutePath())) {
            // store the old name to delete after the update
            $this->temp = $this->getAbsolutePath();
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }



    /**
 *
 * @ORM\PreFlush()
 *
 *
 */
    public function upload()
    {
        if(isset($this->uploadedFiles)) {

            foreach ($this->uploadedFiles as $uploadedFile) {
                $file = new File();

                /*
                 * These lines could be moved to the File Class constructor to factorize
                 * the File initialization and thus allow other classes to own Files
                 */
                $path = $uploadedFile->getClientOriginalName();
                $file->setPath($path);
                $file->setSize($uploadedFile->getClientSize());
                $file->setName($uploadedFile->getClientOriginalName());

                $uploadedFile->move($file->getUploadRootDir(), $path);

                $this->files->add($file);

                $file->setDocument($this);

                unset($uploadedFile);
            }
        }

        else{

        }

    }

    /**
     * ORM\PreRemove()
     */
    public function storeFilenameForRemove()
    {

        foreach(  $this->files  as $img){
            $this->temp->add($img->getAbsolutePath());
        }

    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        foreach(  $this->files  as $img){
            if (isset($img)) {
                unlink($img->getAbsolutePath($this->stockage));
            }
        }
    }

    function __toString()
    {
        return $this->name;
    }



    /**
     * Add file
     *
     * @param \IolaCorporation\NewsBundle\Entity\File $file
     *
     * @return Album
     */
    public function addFile(\IolaCorporation\NewsBundle\Entity\File $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \IolaCorporation\NewsBundle\Entity\File $file
     */
    public function removeFile(\IolaCorporation\NewsBundle\Entity\File $file)
    {
        $this->files->removeElement($file);
    }

    /**
     * Add news
     *
     * @param \IolaCorporation\NewsBundle\Entity\News $news
     *
     * @return Album
     */
    public function addNews(\IolaCorporation\NewsBundle\Entity\News $news)
    {
        $this->news[] = $news;

        return $this;
    }

    /**
     * Remove news
     *
     * @param \IolaCorporation\NewsBundle\Entity\News $news
     */
    public function removeNews(\IolaCorporation\NewsBundle\Entity\News $news)
    {
        $this->news->removeElement($news);
    }
}
