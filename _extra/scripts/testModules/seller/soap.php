<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\SoapClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->addService('trainingSellerSellerRepositoryV1');

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


$client->trainingSellerSellerRepositoryV1Save($mySeller);
$client->trainingSellerSellerRepositoryV1GetByIdentifier(['objectIdentifier' => $mySeller['object']['identifier']]);
$client->trainingSellerSellerRepositoryV1DeleteByIdentifier(['objectIdentifier' => $mySeller['object']['identifier']]);

$sp = $client->trainingSellerSellerRepositoryV1Save($mySeller);
$client->trainingSellerSellerRepositoryV1GetById(['objectId' => $sp->sellerId]);
$client->trainingSellerSellerRepositoryV1GetList($mySearch);
$client->trainingSellerSellerRepositoryV1DeleteById(['objectId' => $sp->sellerId]);

