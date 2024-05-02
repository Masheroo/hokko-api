<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $client->request('post', '/api/login', [
            'username' => 'admin@admin.admin',
            'password' => 'admin123'
        ]);

        $this->assertResponseIsSuccessful();
    }
}
