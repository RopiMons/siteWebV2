<?php

namespace IolaCorporation\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * file
 *
 * @ORM\Table(name="File")
 * @ORM\Entity(repositoryClass="IolaCorporation\NewsBundle\Repository\fileRepository")
 */
class File
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="files")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     **/
    private $document;

    private $lieux;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function getPath()
{
    return $this->path;
}
    public function setPath($p)
    {
        $this->path = $p;
    }
    public function getSize()
    {
        return $this->size;
    }
    public function setSize($p)
    {
        $this->size = $p;
    }
    public function getFile()
    {
        return $this->file;
    }
    public function add($p)
    {
        $this->file = $p;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($p)
    {
        $this->name = $p;
    }
    public function getDocument()
    {
        return $this->document;
    }
    public function setDocument($p)
    {
        $this->document = $p;
    }



    public function getAbsolutePath($lieu)
    {
        $this->lieux = $lieu;
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return $this->lieux;
    }

    public function __construct($lieux = 'uploads/documents')
    {
        $this->lieux = $lieux;
    }


}
