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
        $form = $this->createForm(PropertyType::class, $property, [
            'heatChoices' => $property->heatType
        ]);
        $form->handlerequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $property = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($property);
            $entityManager->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/edit.html.twig', [
            'controller_name' => 'AdminController',
            'property' => $property,
            'form' => $form->createView(),
            'choices' => $property->heatType
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="admin.delete")
     */
    public function getDelete(PropertyRepository $repository, int $id, Request $request)
    {
        $property = $repository->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($property);
        $entityManager->flush();
        $this->addFlash('success', 'Bien supprimé avec succès');
        return $this->redirectToRoute('admin');
        return $this->render('admin/delete.html.twig', [
            'controller_name' => 'AdminController',
            'property' => $property
        ]);
    }
}
