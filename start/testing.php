<?php
require __DIR__.'/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8000/',
    'defaults' => [
        'exceptions' => false
    ]
]);

$nickname = 'ObjectOrienter'.rand(0, 999);
$data = array(
    'nickname' => $nickname,
    'avatarNumber' => 5,
    'tagLine' => 'a test dev!'
);
// 1) Create a programmer resource
$response = $client->post('/api/programmers', [
    'body' => json_encode($data)
]);

echo (string)$response->getBody();
echo "\n\n";

// 2) GET a programmer resource
$response = $client->get('/api/programmers/'.$nickname);
/** @var GuzzleHttp\Psr7\Response $response **/
echo (string)$response->getBody();
echo "\n\n";
