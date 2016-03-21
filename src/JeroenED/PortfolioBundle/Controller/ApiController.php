<?php
namespace JeroenED\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of ApiController
 *
 * @author Jeroen De Meerleer <me@jeroened.be>
 */
class ApiController extends Controller {
    /**
     * @Route("/api/getPage/{slug}", defaults={ "slug" = "none"})
     */
    public function getPageAction($slug)
    {
        if($slug == 'none') throw new NotFoundHttpException('Page not found');
                
        $page = $this->getDoctrine()->getRepository('JeroenEDPortfolioBundle:Page')->findOneBy(array("slug" => $slug), array());
        if ($page == null ) throw new NotFoundHttpException('Page not found');
        return new Response("<h1>" . $page->getTitle() . "</h1>" . $page->getHtml());
    }
}
