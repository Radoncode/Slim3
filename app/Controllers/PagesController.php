<?php

namespace App\Controllers;

use Symfony\Component\Mime\Email;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PagesController extends Controller {

    public function home(RequestInterface $request, ResponseInterface $response)
    {
        $this->render($response, 'pages/home.twig');
    }

    public function getContact(RequestInterface $request, ResponseInterface $response)
    {   
        return $this->render($response, 'pages/contact.twig');
        
    }

    public function postContact(RequestInterface $request, ResponseInterface $response)
    {   
        if (false) {
            $this->flash('Votre message a bien été envoyé');
        } else {
            $this->flash("Certains champs n'ont pas été remplis correctement", 'error');
        }
        
       /* $email = (new Email())
                ->from(($request->getParam('email')))
                ->to('contact@radoncode.fr')
                ->text('Un email vous a été envoyé : '.$request->getParam('content'));
       $this->mailer->send($email);*/
       return $this->redirect($response,'contact');
    }    
}