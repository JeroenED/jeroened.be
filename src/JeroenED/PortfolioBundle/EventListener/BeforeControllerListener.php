<?php

/*
 * The MIT License
 *
 * Copyright 2015 Jeroen De Meerleer <me@jeroened.be>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace JeroenED\PortfolioBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\SecurityContextInterface;
use JeroenED\PortfolioBundle\Model\InitializableControllerInterface;

/**
 * @author Matt Drollette <matt@drollette.com>
 */
class BeforeControllerListener
{
    private $security_context;

    public function __construct(SecurityContextInterface $security_context)
    {
        $this->security_context = $security_context;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            // not a object but a different kind of callable. Do nothing
            return;
        }

        $controllerObject = $controller[0];

        // skip initializing for exceptions
        if ($controllerObject instanceof ExceptionController) {
            return;
        }

        if ($controllerObject instanceof InitializableControllerInterface) {
            // this method is the one that is part of the interface.
            $controllerObject->initialize($event->getRequest(), $this->security_context);
        }
    }
}