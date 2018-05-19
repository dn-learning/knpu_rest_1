<?php
namespace AppBundle\Test;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class ApiTestCase extends KernelTestCase
{
    private static $staticClient;
    /**
     * @var Client
     */
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client([
            'base_uri' => 'http://localhost:8000',
            'defaults' => [
                'exceptions' => false
            ]
        ]);
    }

    /**
     *  setup before tests
     */
    protected function setUp()
    {
        $this->client = self::$staticClient;
        $this->purgeDatabase();
    }

    /**
     * Clean up Kernel usage in this test.
     */
    protected function tearDown()
    {
        // purposefully not calling parent class, which shuts down the kernel
    }

    /**
     * preparing db before tests
     */
    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getService('doctrine.orm.default_entity_manager'));
        $purger->purge();
    }

    /**
     * allows usage of containers in tests
     */
    protected function getService($id)
    {
        return self::$kernel->getContainer()
        ->get($id);
    }
}
