<?php

namespace Ropi\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MapController extends Controller {

    /**
     * @Route("/map/scripts", name="CMS_generate_map_script")
     * @Template("RopiCMSBundle:Map:_mapHead.html.twig")
     */
    public function generateMapScriptAction() {

        $map = $this->get("ropi.cms.map");

        return array(
            'marqueurs' => $map->getMarqueurs()
        );

    }
}
