<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 1/06/16
 * Time: 21:15
 */

namespace Ropi\CMSBundle\Map;

use Doctrine\ORM\EntityManager;
use Ropi\CommerceBundle\Entity\Commerce;

class Map
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    private $apiKey;

    public function __construct(EntityManager $entityManager,$apiKey)
    {
        $this->entityManager = $entityManager;
        $this->apiKey = $apiKey;
    }

    public function geoCoder($adresse){

        $url_address = utf8_encode($adresse);
        $url_address = urlencode($url_address);
        $query = "https://maps.googleapis.com/maps/api/geocode/json?address=$url_address&key=$this->apiKey";
        $results = json_decode(file_get_contents($query),true);

        if($results["status"] == "OK" && isset($results["results"]["0"])) {
            return $results["results"][0]["geometry"]["location"];
        }else{
            throw new NotFoundResourceException();
        }
    }
    
    public function getMarqueurs(){

        $commerces = $this->entityManager->getRepository(Commerce::class)->findBy(array(
            'visible' => true,
            'valide' => true,
            
        ));

        $retour = array();

        if($commerces){

            foreach ($commerces as $key => $commerce){

                if($commerce->getLat()==null || $commerce->getLon()==null){
                    
                    if(isset($commerce->getAdresses()[0])){
                        $adresse = $commerce->getAdresses()[0];
                        $ville = $adresse->getVille();
                        $test = $this->geoCoder($adresse->getRue()." ".$adresse->getNumero()." - ".$ville->getCodePostal() ." " .$ville->getVille()." ".$ville->getPays()->getNom());

                        $commerce->setLat($test["lat"]);
                        $commerce->setLon($test["lng"]);
                    }else{
                        break;
                    }
                }

                $retour[$key]["lat"] = $commerce->getLat();
                $retour[$key]["lon"] = $commerce->getLon();
                $retour[$key]["nom"] = $commerce->getNom();
            }

            $this->entityManager->flush();
        }
        
        return $retour;
    }

}