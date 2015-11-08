<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 8/11/15
 * Time: 12:38
 */

namespace Ropi\CMSBundle\Map;


use Ivory\GoogleMap\Events\Event;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\MapTypeId;
use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMapBundle\Entity\InfoWindow;
use Ivory\GoogleMap\Events\MouseEvent;
use Ivory\GoogleMap\Overlays\MarkerImage;

class MapBuilder
{
    public function getMap(){
        $map = $this->initParam();

        return $map;
    }

    private function initParam(){
        $map = new Map();

        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map_canvas');

        $map->setAsync(false);
        $map->setAutoZoom(true);

        $map->setCenter(50.454608, 3.952336, true);
        $map->setMapOption('zoom', 3);

        $map->setBound(50.439457, 3.922652, 50.462712, 3.969301, true, true);

        $map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
        $map->setMapOption('mapTypeId', 'roadmap');

        $map->setMapOption('disableDefaultUI', true);
        $map->setMapOption('disableDoubleClickZoom', true);
        $map->setMapOptions(array(
            'disableDefaultUI'       => true,
            'disableDoubleClickZoom' => true,
        ));

        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '300px');

        $map->setLanguage('fr');

        $marker = new Marker();

        // Configure your marker options
        $marker->setPrefixJavascriptVariable('marker_');
        $marker->setPosition(50.453929, 3.952496, true);
        $marker->setAnimation(Animation::DROP);

        $marker->setOption('clickable', true);
        $marker->setOption('flat', true);
        $marker->setOptions(array(
            'clickable' => true,
            'flat'      => true,
        ));

        $infoWindow = new InfoWindow();

        // Configure your info window options
        $infoWindow->setPrefixJavascriptVariable('info_window_');
        $infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
        $infoWindow->setContent('<h1>Le Carillon</h1><p>Premier café partenaire du Ropi</p>');
        $infoWindow->setOpen(false);
        $infoWindow->setAutoOpen(true);
        $infoWindow->setOpenEvent(MouseEvent::CLICK);
        $infoWindow->setAutoClose(false);
        $infoWindow->setOption('disableAutoPan', true);
        $infoWindow->setOption('zIndex', 10);
        $infoWindow->setOptions(array(
            'disableAutoPan' => true,
            'zIndex'         => 10,
        ));


        $markerImage = new MarkerImage();

        // Configure your marker image options
        $markerImage->setPrefixJavascriptVariable('marker_image_');
        $markerImage->setUrl('/img/ropi_Rrouge.png');
        $markerImage->setAnchor(20, 34);
        $markerImage->setOrigin(0, 0);
        $markerImage->setSize(20, 34, "px", "px");
        $markerImage->setScaledSize(20, 34, "px", "px");

        $marker->setInfoWindow($infoWindow);
        $marker->setIcon($markerImage);
        $map->addMarker($marker);

        return $map;
    }
}