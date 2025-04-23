<?php

namespace App\DataFixtures;

use App\Entity\ShortenUrl;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $shorten = new ShortenUrl();
        $shorten
            ->setOriginalUrl("https://react.dev/reference/react-dom/client/hydrateRoot")
            ->setCode("cpsicd");

        $shortenBis = new ShortenUrl();
        $shortenBis
            ->setOriginalUrl("https://www.seloger.com/classified-search?distributionTypes=Buy,Buy_Auction&estateTypes=House,Apartment&locations=AD09FR23&numberOfBedroomsMin=2&numberOfRoomsMin=4&priceMax=1500000&priceMin=700000")
            ->setCode("jfnujn");

        $manager->persist($shorten);
        $manager->persist($shortenBis);

        $manager->flush();
    }
}
