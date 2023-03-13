<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class StoreController extends AbstractController
{
    #[Route('/', name: 'app_store_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}