<?php

namespace App\Controller;

use App\Entity\ShortenUrl;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RedirectController extends AbstractController
{
    #[Route('/v/{code}', name: 'app_redirect')]
    public function redirectFromCode(ShortenUrl $url): Response
    {
        return $this->redirect($url->getOriginalUrl());
    }
}
