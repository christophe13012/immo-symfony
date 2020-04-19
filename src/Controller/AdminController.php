<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PropertyType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/edit/{id}", name="admin.edit")
     */
    public function getEdit(PropertyRepository $repository, int $id, Request $request)
    {
        $property = $repository->find($id);
        $form = $this->createForm(PropertyType::class, $property);
        $form->handlerequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);
            $entityManager->flush();
            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/edit.html.twig', [
            'controller_name' => 'AdminController',
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}
