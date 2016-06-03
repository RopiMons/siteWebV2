<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 31/05/16
 * Time: 20:18
 */

namespace Ropi\CMSBundle\Parser;


use Ropi\ParametresBundle\Service\Parametres;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class Parser
{
    /**
     * @var Parametres
     */
    private $parametres;

    public function __construct(Parametres $parametres){

        $this->parametres = $parametres;

    }


    public function parse($text){


        /** &[xxxx] -> A remplacer par le parametre xxxx **/

        $regex = "/[*][[][[:alnum:]]+[]]/";
        $text = $this->doIt($regex,"parametresRetour",$text);


        /** [xxx](http://xxxxxx.xx.xx) -> Lien html **/

        $regex = "/[[].[^]]+[]][(][^)]+[)]/";
        $text = $this->doIt($regex,"linkGenerator",$text);



        return $text;


    }

    private function doIt($regex,$functionName,$text){

        if(preg_match_all($regex,$text,$results)) {

            array_unique($results);

            foreach ($results[0] as $result) {

                $text = str_replace($result, $this->$functionName($result), $text);

            }
        }

        return $text;
    }

    private function linkGenerator($result){

        if(preg_match("/[[].+[]]/",$result,$tab)){
            $nom = substr($tab[0],1,-1);

        }

        if(preg_match("/[(].+[)]/",$result,$tab)){
            $lien = substr($tab[0],1,-1);
        }

        if(isset($nom) && isset($lien)){
            return '<a href="'.$lien.'">'.$nom.'</a>';
        }

        return null;
    }

    private function parametresRetour($result){

        try {

            $result = $this->parametres->getValueOf(substr($result, 2, -1));
        }
        catch (NotFoundResourceException $e){

        }

        return $result;
    }
}