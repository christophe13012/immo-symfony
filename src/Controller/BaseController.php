<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\Search;
use App\Form\ContactType;
use App\Form\SearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/biens", name="properties")
     */
    public function getProperties(PropertyRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handlerequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
        }

        $properties = $repository->findAllOnMarket($search);
        $paginated = $paginator->paginate(
            $properties, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );
        return $this->render('properties.html.twig', [
            'properties' => $paginated,
            'form' => $form->createView(),
            'search' => $search
        ]);
    }
    /**
     * @Route("/bien/{id}", name="property")
     */
    public function getProperty(PropertyRepository $repository, int $id, Request $request, \Swift_Mailer $mailer)
    {
        $property = $repository->find($id);

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handlerequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom($contact->getEmail())
                ->setTo('symfonytest13@gmail.com')
                ->setBody(
                    $contact->getMessage(),
                    'text/html'
                );
            $mailer->send($message);
        }

        return $this->render('property.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
            'contact' => $contact
        ]);
    }
}
