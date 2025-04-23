<?php

namespace App\Controller;

use App\Entity\ShortenUrl;
use App\Form\ShortenUrlType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request): Response
    {
        $shortenUrl = new ShortenUrl();
        $form = $this->createForm(ShortenUrlType::class, $shortenUrl);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($shortenUrl);
        }

        return $this->render('index/index.html.twig', [
            'shortenUrlForm' => $form,
        ]);
    }
}
