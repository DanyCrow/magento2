<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\RestClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->connect();

$mySeller = [
    'object' => [
        'identifier' => 'nkandel',
        'name' => 'Nicolas Kandel',
    ]
];

$mySearch = [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field' => 'identifier',
                        'condition_type' => 'like',
                        'value' => '%ola%',
                    ]
                ]
            ]
        ]
    ]
];


$client->post('rest/V1/seller/', $mySeller);
$client->get('rest/V1/seller/identifier/' . $mySeller['object']['identifier']);
$client->delete('rest/V1/seller/identifier/' . $mySeller['object']['identifier']);

$ps = $client->post('rest/V1/seller/', $mySeller);
$client->get('rest/V1/seller/id/' . $ps['seller_id']);
$client->get('rest/V1/seller/?' . http_build_query($mySearch));
$client->delete('rest/V1/seller/id/' . $ps['seller_id']);



