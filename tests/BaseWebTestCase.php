<?php

declare(strict_types = 1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseWebTestCase extends WebTestCase
{
    protected function getJsonDecodedResponse(KernelBrowser $client): array
    {
        return json_decode($client->getResponse()->getContent(), true);
    }
}