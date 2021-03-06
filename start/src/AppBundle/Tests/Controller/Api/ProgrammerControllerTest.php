<?php
namespace AppBundle\Tests\Controller\Api;

use AppBundle\Test\ApiTestCase;

class ProgrammerControllerTest extends ApiTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->createUser('weaverryan');
    }


    public function testPOST()
    {
        $nickname = 'ObjectOrienter';
        $data = array(
          'nickname' => $nickname,
          'avatarNumber' => 5,
          'tagLine' => 'a test dev!'
      );
        // 1) Create a programmer resource
        $response = $this->client->post('/app_dev.php/api/programmers', [
          'body' => json_encode($data)
      ]);

        // /** @var \GuzzleHttp\Psr7\Response $response **/
        // foreach ($response->getHeaders() as $name => $values) {
        //     echo $name . ': ' . implode(', ', $values) . "\r\n";
        // }
        // echo $response->getBody()->getContents();
        // echo "\n\n";

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $this->assertEquals('/app_dev.php/api/programmers/', $response->getHeader('Location')[0]);
        $finishedData = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('nickname', $finishedData);
        $this->assertEquals('ObjectOrienter', $finishedData['nickname']);
    }
}
