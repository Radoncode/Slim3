<?php

namespace App\Controllers;

use Symfony\Component\Mime\Email;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;

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
        $errors = [];
        Validator::email()->validate($request->getParam('email')) || $errors['email'] = "Votre email n'est pas valide";
        Validator::notEmpty()->validate($request->getParam('name')) || $errors['name'] = "Veuillez entrer votre nom";
        Validator::notEmpty()->validate($request->getParam('content')) || $errors['content'] = "Veuillez entrer votre contenu";
        if (empty($errors)) {
            $email = (new Email())
                ->from(($request->getParam('email')))
                ->to('contact@radoncode.fr')
                ->text('Un email vous a été envoyé : '.$request->getParam('content'));
            $this->mailer->send($email);
            $this->flash('Votre message a bien été envoyé');
            return $this->redirect($response,'contact');
        } else {
            $this->flash("Certains champs n'ont pas été remplis correctement", 'error');
            $this->flash($errors, 'errors');
            return $this->redirect($response,'contact', 400);
        }
        
       
    }    
}