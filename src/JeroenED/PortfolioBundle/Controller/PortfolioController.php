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
namespace JeroenED\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use JeroenED\CmsEDBundle\Model\InitializableControllerInterface;

class PortfolioController extends Controller implements InitializableControllerInterface
{
    private $portfolio;
    private $menu;
    
    public function initialize( Request $request, TokenStorage $security_context) {
        $allPortfolioItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->findBy(array(), array('rank' => 'asc'));
        $i=0;
        foreach ($allPortfolioItems as $item) {
            $this->portfolio[$i]['title'] = $item->getTitle();
            $this->portfolio[$i]['rank'] = $item->getRank();
            $this->portfolio[$i]['pages'] = json_decode($item->getPages(), true);
            $i++;
        }
        $allMenuItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:MenuItem')->findBy(array(), array('rank' => 'asc'));
        $i=0;
        foreach ($allMenuItems as $item) {
            $this->menu[$i]['destination'] = $item->getDestination();
            $this->menu[$i]['external'] = (strpos($item->getDestination(), 'http://') !== false || strpos($item->getDestination(), 'https://') !== false ) ? true : false;
            $this->menu[$i]['label'] = $item->getLabel();
            $i++;
        }
    }

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('JeroenEDPortfolioBundle:Portfolio:portfolio.html.twig', array('portfolio' => $this->portfolio, 'menu' => $this->menu));

    }

    /**
     * @Route("/page/{slug}")
     */
    public function pageAction($slug) {
        return $this->render('JeroenEDPortfolioBundle:Portfolio:page.html.twig', array('slug' => $slug, 'portfolio' => $this->portfolio, 'menu' => $this->menu));
    }

    /**
     * @Route("/changelog")
     */
    public function changelogAction() {
        $file = $this->get('kernel')->getRootDir() . '/../changelog.md';
        $handler = $this->container->get('kernel')->locateResource('@JeroenEDPortfolioBundle') . '/markdown/handler.php';
	require $handler;
        return new Response();
    }
}
