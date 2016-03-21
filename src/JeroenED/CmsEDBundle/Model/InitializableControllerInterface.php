<?php

namespace JeroenED\CmsEDBundle\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * @author Matt Drollette <matt@drollette.com>
 */
interface InitializableControllerInterface
{
    public function initialize(Request $request, TokenStorage $security_context);
}
