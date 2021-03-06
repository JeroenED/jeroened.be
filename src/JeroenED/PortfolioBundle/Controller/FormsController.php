<?php

namespace JeroenED\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Description of FormsController
 *
 * @author Jeroen De Meerler <me@jeroened.be>
 */
class FormsController extends Controller {
    
    /**
     * @Route("/forms/contact")
     * @Method("POST")
     */
    public function contactSubmitAction(Request $request) {

        $postValues = $request->request->all();
        $name = $postValues['name'];
        $message = $postValues['message'];
        $subject = $postValues['subject'];
        $email = $postValues['email'];
        $recipient = $this->container->getParameter('forms_to');
        
        $error = '';
        if (!empty($postValues['blank-check'])) $error = "1100111000110110011001001010111001100";

        if (empty($name) || empty($message) || empty($subject)) $error = "Gelieve alle velden in te vullen";
        if (!$this->validateEmail($email)) $error = "E-mailadres niet geldig";

        if (!empty($error)) {
            $response = new Response(json_encode(array('error' => $error)));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        
        $mailmsg = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array($email => $name))
        ->setTo($recipient)
        ->setBody($message,'text/plain');
        $this->get('mailer')->send($mailmsg);
        $response = new Response(json_encode(array('message' => "Uw bericht werd verzonden")));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    private function validateEmail($email) {
        $email_array = explode("@", $email);
        if (isset($email_array[1])) return checkdnsrr($email_array[1]);
        return false;
    }
}
