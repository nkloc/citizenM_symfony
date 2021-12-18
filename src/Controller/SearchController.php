<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class SearchController extends AbstractController
{
    #[Route('/hotel/search', name: 'search_hotel')]
    public function searchHotel(Request $request)
    {
        return $this->render('search/hotel.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }
}
