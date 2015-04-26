<?php

namespace JeroenED\Portfolio\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $allItems = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:PortfolioItem')->findAll();
        $i=0;
        foreach ($allItems as $item) {
            $portfolio[$i]['title'] = $item->getTitle();
            $portfolio[$i]['rank'] = $item->getRank();
            $portfolio[$i]['pages'] = unserialize($item->getPages());
            $i++;
        }
        return $this->render('JeroenEDPortfolioBundle:Portfolio:portfolio.html.twig', array('portfolio' => $portfolio));
    }
    

}
