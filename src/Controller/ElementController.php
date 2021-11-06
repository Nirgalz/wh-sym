<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ElementController extends AbstractController
{
    /**
     * @Route("/elements/create", name="createElement", methods="POST")
     * @param Request $request
     * @return Response
     */
    public function createElement(Request $request): Response
    {
dump($request->getContent());
$response = new Response();
//        $response->headers->set('Symfony-Debug-Toolbar-Replace', 1);
        $response->setContent("cacacaca");
        return $response;
//        return $this->json(['name' => $request->getContent()]);

    }
}