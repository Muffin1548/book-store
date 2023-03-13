<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $em
    )
    {
    }

    #[Route('registration', name: 'app_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request): RedirectResponse|Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            try {
                $this->em->persist($user);
                $this->em->flush();
                return $this->redirectToRoute('app_store_index');
            } catch (\Exception $e) {

            }
        }

        return $this->render('security/registration.html.twig', ['form' => $form]);
    }
}