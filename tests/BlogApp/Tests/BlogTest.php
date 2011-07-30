<?php
namespace BlogApp\Tests;

require_once __DIR__ . '/../../../silex.phar';


use Silex\WebTestCase;

class BlogTest extends WebTestCase
{
	public function createApplication()
	{
	    return require __DIR__.'/../../../app/blog.php';
	}
	public function testIndexPage()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/');
	    $this->assertTrue($client->getResponse()->isOk());
	    $this->assertEquals(1, count($crawler->filter('h1:contains("Blog posts")')));
	}
	public function testViewPage()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/1');
	    $this->assertTrue($client->getResponse()->isOk());
	    $this->assertEquals(1, count($crawler->filter('h1:contains("Lorem ipsum dolor sit amet")')));
	}
}