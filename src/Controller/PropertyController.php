<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PropertyController extends AbstractController {

    /**
     * @var PropertyRepository
     */
    private $repository;
    
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request):Response
    {

            /* pour creer un formulaire de recherche :
                1- creer l entity
                2- creer le formulaire
                3- gerer le traitement dans le controller
                */
                $search = new PropertySearch();
                $form = $this->createForm(PropertySearchType::class, $search);

                $form->handleRequest($request);


                $query = $this->repository->findAllVisibleQuery($search);
                //$property[0]->setSold(true);
                //$this->em->flush();
                //dump($property);

                $properties = $paginator->paginate(
                    $query, /* query NOT result */
                    $request->query->getInt('page', 1), /*page number*/
                    12 /*limit per page*/
                );       
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, $slug, Request $request, ContactNotification $notification):Response
    {
        if ($slug !== $property->getSlug()) {
           return $this->redirectToRoute('property.show',[
               'id'=> $property->getId(),
               'slug' => $property->getSlug()
           ], 301);
        }

        $contact = new Contact();
        $contact->setProperty($property);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $notification->notify($contact);
            $this->addFlash('success', " Votre email ?? bien ??t?? envoy??");

           /*  return $this->redirectToRoute('property.show',[
                'id'=> $property->getId(),
                'slug' => $property->getSlug()
            ]); */
        }

        // quand on inject la class Property celui la permet de faire $this->repository->find($id) puisqu il trouve 
        // le id sur la route
        //$property = $this->repository->find($id);
        //dump($property);
        return $this->render('property/show.html.twig',[
            'current_menu' => 'properties',
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
}