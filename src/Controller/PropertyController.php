<?php

namespace App\Controller;

use App\Entity\Property;
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
       /*  $property = new Property();
        $property->setTitle("Mon bien")
                ->setRooms(4)
                ->setBedrooms(2)
                ->setDescription("une petite description")
                ->setSurface(60)
                ->setPrice(200000)
                ->setPostalCode(50060)
                ->setFloor(2)
                ->setCity("casablanca")
                ->setAddress("25 rue lot iraki 2")
                ->setHeat(1);
        
                $em = $this->getDoctrine()->getManager();
                $em->persist($property);
                $em->flush(); */

                //$repository = $this->getDoctrine()->getRepository(Property::class);
                $query = $this->repository->findAllVisibleQuery();
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
            'properties' => $properties
        ]);
    }

     /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, $slug):Response
    {
        if ($slug !== $property->getSlug()) {
           return $this->redirectToRoute('property.show',[
               'id'=> $property->getId(),
               'slug' => $property->getSlug()
           ], 301);
        }
        // quand on inject la class Property celui la permet de faire $this->repository->find($id) puisqu il trouve 
        // le id sur la route
        //$property = $this->repository->find($id);
        //dump($property);
        return $this->render('property/show.html.twig',[
            'current_menu' => 'properties',
            'property' => $property
        ]);
    }
}