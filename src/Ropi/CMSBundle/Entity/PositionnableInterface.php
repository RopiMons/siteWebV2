<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Ropi\CMSBundle\Entity;

/**
 *
 * @author Laurent Cardon <laurent.cardon@ropi.be>
 */
interface PositionnableInterface {

public function setPosition($position);

public function getPosition();

}
