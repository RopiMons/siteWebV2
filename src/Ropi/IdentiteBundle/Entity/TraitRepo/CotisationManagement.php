<?php

namespace Ropi\IdentiteBundle\Entity\TraitRepo;

use Ropi\AuthenticationBundle\Entity\Cotisation;

trait CotisationManagement{
    
     /**
     * @return Cotisation
     */
    abstract public function getCotisations();

    private function getLastCotisation($nom){
        $last = null;

        foreach ($this->getCotisations() as $cotisation){
            if($last==null && $cotisation->$nom() != null){
                $last = $cotisation;
            }elseif($cotisation!=null && $last!=null){
                if($last->$nom() < $cotisation->$nom()){
                    $last = $cotisation;
                }
            }
        }

        return $last;
    }

    public function getLastCotisationPaye(){
        return $this->getLastCotisation('getDateEcheance');
    }

    public function getLastCotisationProcedure(){
        return $this->getLastCotisation('getDateCreation');
    }

    public function hasActifCotisation(){
        if(($cotisation = $this->getLastCotisationPaye()) != null)
        {
            return new \DateTime() < $cotisation->getDateEcheance();
        }

        return null;
    }

    public function hasActifProcedurePaiement(){
        if(($cotisation =  $this->getLastCotisationProcedure()) != null ){

            return new \DateTime() < date_modify($cotisation->getDateCreation(),"+1 month");

        }

        return false;
    }

}

