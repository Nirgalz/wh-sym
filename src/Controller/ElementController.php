<?php

namespace App\Controller;

use App\Entity\Element;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElementController extends AbstractController
{
    /**
     * @Route("/elements/create", name="createElement", methods="POST")
     * @param Request $request
     * @return Response
     * @throws \ErrorException
     */
    public function createElement(Request $request): Response
    {
        if ($request->isMethod("POST")) {
            $entityManager = $this->getDoctrine()->getManager();
            $data = json_decode($request->getContent(), true);

            $element = new Element();
            $element->setName($data["name"]);
            $entityManager->persist($element);
            $entityManager->flush();

            $response = new Response();
            $response->setContent($data["name"]);
            return $response;
        }
        throw new \ErrorException();
    }
}