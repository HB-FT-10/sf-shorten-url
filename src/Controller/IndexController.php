<?php

namespace App\Controller;

use App\Entity\ShortenUrl;
use App\Form\ShortenUrlType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $shortenUrl = new ShortenUrl();
        $form = $this->createForm(ShortenUrlType::class, $shortenUrl);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $characters = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
            $shortCode = "";

            for ($i = 0; $i < 6; $i++) {
                $shortCode .= $characters[random_int(0, strlen($characters) - 1)];
            }

            $shortenUrl->setCode($shortCode);
            $em->persist($shortenUrl);
            $em->flush();

            $redirectUrl = $this->generateUrl(
                'app_redirect',
                ['code' => $shortenUrl->getCode()],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $this->addFlash('success', 'Votre lien a été créé : ' . $redirectUrl);
        }

        return $this->render('index/index.html.twig', [
            'shortenUrlForm' => $form,
        ]);
    }
}
