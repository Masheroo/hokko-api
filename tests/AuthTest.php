<?php

namespace App\Tests;

class AuthTest extends BaseWebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();

        $client->jsonRequest('post', '/api/login', [
            'username' => 'admin@admin.admin',
            'password' => 'admin123'
        ]);

        $this->assertResponseIsSuccessful();

        $response = $this->getJsonDecodedResponse($client);
        self::assertArrayHasKey('token', $response);
    }
}
