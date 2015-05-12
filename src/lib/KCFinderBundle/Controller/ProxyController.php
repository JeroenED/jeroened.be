<?php

namespace lib\KCFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProxyController extends Controller
{

	public function browseAction()
	{
		return $this->proxyForward('browse.php');
	}

	public function cssAction()
	{
		return $this->proxyForward('css.php');
	}

	public function js_localizeAction()
	{
		return $this->proxyForward('js_localize.php');
	}

	public function uploadAction()
	{
		return $this->proxyForward('upload.php');
	}
	
	public function js_browser_joinerAction()
	{
		return $this->proxyForward('joiner.php');
	}
	
	private function proxyForward($file)
	{
		$previousCwd = getcwd();
		chdir(__DIR__ . '/../kcfinder/');
		
		require $file;
		
		chdir($previousCwd);
		
		ob_end_flush();
		
		return new Response();
	}

}
