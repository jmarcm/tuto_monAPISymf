<?php

namespace App\Controller;

use App\Entity\Produit;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeProduitController extends AbstractController
{

    function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @Route("/liste/produit", name="app_liste_produit")
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ListeProduitController.php',
        ]);
    }

    /**
     * @Route("/apitest", name="apitest")
     */
    public function apitest(Request $request): Response
    {

        $produitsRepository = $this->em->getRepository(Produit::class);
        $listeProduits = $produitsRepository->findAll();

        $resultat = [];

        foreach ($listeProduits as $produit) {
            $resultat[] = $produit->getNom();
        }

        $response = new JsonResponse($resultat);

        return $response;
    }
}
