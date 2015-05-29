<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ropi\CMSBundle\Twig;

/**
 * Description of CMSExtension
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
class CMSExtension extends \Twig_Extension {

    public function getTests() {
        return [
            'instanceof' => new \Twig_Function_Method($this, 'isInstanceof')
        ];
    }

    /**
     * @param $var
     * @param $instance
     * @return bool
     */
    public function isInstanceof($var, $instance) {
        return get_class($var) === $instance;
    }

    public function getName() {
        return 'cms_extension';
    }

}
