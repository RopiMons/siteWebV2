<?php

namespace Ropi\IdentiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Contact
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Ropi\IdentiteBundle\Entity\ContactRepository")
 * @UniqueEntity(
 *     fields = {"valeur"},
 *     repositoryMethod = "findUniqueEmail",
 *     message = "Cette adresse email est déjà enregistrée dans notre système"
 * )
 *
 */
class Contact 
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur", type="string", length=100)
     */
    private $valeur;
    
    /**
     *
     * @var typeMoyenContact
     * @ORM\ManyToOne(targetEntity="TypeMoyenContact", cascade={"persist"})
     */
    private $typeContact;
    /**
     *@ORM\ManyToOne(targetEntity="Personne", inversedBy="contacts", cascade={"persist"})
     */
     private $personne;
     
    


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
     * Set valeur
     *
     * @param string $valeur
     * @return Contact
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string 
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set typeContact
     *
     * @param \Ropi\IdentiteBundle\Entity\TypeContact $typeContact
     * @return Contact
     */
    public function setTypeContact(\Ropi\IdentiteBundle\Entity\TypeMoyenContact $typeContact = null)
    {
        $this->typeContact = $typeContact;

        return $this;
    }

    /**
     * Get typeContact
     *
     * @return \Ropi\IdentiteBundle\Entity\TypeContact 
     */
    public function getTypeContact()
    {
        return $this->typeContact;
    }

    /**
     * Set personne
     *
     * @param \Ropi\IdentiteBundle\Entity\Personne $personne
     * @return Contact
     */
    public function setPersonne(\Ropi\IdentiteBundle\Entity\Personne $personne = null)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * Get personne
     *
     * @return \Ropi\IdentiteBundle\Entity\Personne 
     */
    public function getPersonne()
    {
        return $this->personne;
    }
    
     /**
     * @Assert\Callback
     *
     */
    public function validate(ExecutionContextInterface $context) {

        $mdc = $this->typeContact;
       
        switch ($mdc->getValidateur()) {
            case "Email":
                
                $emailValidator = new Assert\EmailValidator();
                $emailValidator->initialize($context);
                 
                 $emailValidator->validate($this->valeur, new Assert\Email(array(
                    'message' => "Ce mail {{ value }} n'est pas valide",
                    'checkMX' => true,
                    'checkHost' => true,
                
                )));
               
                 
                break;

            case "type: integer":
                $integerValidator = new Assert\TypeValidator();
                $integerValidator->initialize($context);
                $integerValidator->validate($this->valeur, new Assert\Type(array(
                    'type' => 'numeric',
                    'message' => "La valeur {{ value }} n'est pas un nombre",
                )))
                ;
                break;
            case "":
                break;
            default :
                $context
                        ->buildViolation("Impossible de valider les données")
                        ->atPath("valeur")
                        ->addViolation()
                ;
                break;
        }
    }
}
