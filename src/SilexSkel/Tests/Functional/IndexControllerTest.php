<?php

use Silex\WebTestCase;

class IndexControllerTest extends WebTestCase
{
    public function createApplication()
    {
        $app = new Silex\Application();
        
        require __DIR__.'/../../../../app/config/dev.php';
        require __DIR__.'/../../../../app/app.php';
        require __DIR__.'/../../../../app/routes.php';
        
        return $app;
    }
    
    public function testPageSuccess()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');
        
        $this->assertTrue($client->getResponse()->isOk());
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertCount(1, $crawler->filter('h1:contains("Silex Skeleton Index Page, yay!")'));
    }
    
    public function testPageNotFound()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/pagenotfound');
        
        $this->assertTrue($client->getResponse()->isNotFound());
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertContains('Sorry, the page you are looking for could not be found.', $crawler->html());
    }
}
