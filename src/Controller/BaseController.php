<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/", methods={"GET","HEAD"}, name="accueil")
     */
    public function getAccueil(PropertyRepository $repository)
    {
        $properties = $repository->findLast();
        return $this->render('index.html.twig', [
            'properties' => $properties
        ]);
    }
    /**
     * @Route("/biens", methods={"GET","HEAD"}, name="properties")
     */
    public function getProperties(PropertyRepository $repository)
    {
        $properties = $repository->findAllOnMarket();
        return $this->render('properties.html.twig', [
            'properties' => $properties
        ]);
    }
    /**
     * @Route("/bien/{id}", name="property")
     */
    public function getProperty(PropertyRepository $repository, int $id)
    {
        $property = $repository->find($id);
        return $this->render('property.html.twig', [
            'property' => $property
        ]);
    }
}
