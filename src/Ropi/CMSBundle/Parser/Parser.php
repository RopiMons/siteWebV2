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
        $results = Array();

        preg_match_all($regex,$text,$results);

        array_unique($results);

        foreach($results as $result){

            $text = str_replace($result[0],$this->parametresRetour($result[0]),$text);

        }

        return $text;


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