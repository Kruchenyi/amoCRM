<?php

use myclass\Validator;
use myclass\AuthAmo;
use AmoCRM\{AmoAPI, AmoLead, AmoAPIException, AmoCompany, AmoContact};
use AmoCRM\TokenStorage\TokenStorageException;

require VIEWS . '/incs/header.php';



$fillable = ['name', 'email', 'phone', 'price'];
$data = validField($fillable);
$rules = [
    'name' => [
        'required' => true,
        'min' => 4,
        'max' => 40
    ],
    'email' => [
        'required' => true,
        'email' => true
    ],
    'phone' => [
        'required' => true,
        'phone' => true
    ],
    'price' => [
        'required' => true,
        'num' => true
    ]
];

$validator = new Validator($data, $rules);

$clientId = 'f143840b-28c0-4744-9c61-4070e53a6f21';
$clientSecret = 'H8JibAqHtw307IiJplqLpVtNIx2vixTV82klqiTX9IfaCmV3Z278e66puvyMk84R';
$authCode = 'def50200029c629a6c51b3423fbf8d7f4a8b11aed4a4e9235d28b6f0ab9f9e280e9d496cbeac4f6e20e96cf0cd9c3a6a1a3028008e9a1da7779af7517671252dad3254f2afa192fd189b762044e65d6c1e02d213e0f88338ff43686f95a15840768a5956579e4cc6a805b9751f3460b63a86bbde083aaf64d73cbadf81abd5102e2e1b61ef5ce157f088822da99ec0ec4c8173bf7284216606313372d3c73b9da5037366c67e673a65ab1dcb24ecbe2c3e7a88e3abb19319950aacb989bbad15059bacdb1b1e6d30f9fecf7ef66836c958aa5491e8bf9a94d3b71e1017d4c26822d04ad64b9cddbf1f9bf3532fff56481b1d331d51efaf4d7df2615d13303266038607c117b3e73c9841b67a5d85fd57e1e588b81523f4f3d2924ffdf970253ef41710f62d925778768f7146482d3f410357dba94f46c270ae3440385bd76ce2f8a83c0d97acd37101e6cd5858c4294c7f76cb21d6b9e606f607d75f1c04594ec2f616d8b824c417a5c8f34b8bd35adbc3cacf8e27256837f95f88f179730a6a7131d06f50dd3cca074d9a9758f88100642215ddf674c99cbac3cb9a477f22ddb9d7da98fdb8faacb6abc3cf1c61faca78bd53a94ca21f225eb90e5ec4516d23c38e8b734feee9999fdb185427b2945ad01225fea089eb1eb42bb3b587a247fe';
$redirectUri = 'https://ya.ru/';
$subdomain = 'stopham80';

require VIEWS . '/incs/main.php';
require VIEWS . '/incs/footer.php';
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (!$validator->hasError()) {
        $authAmo = new AuthAmo($clientId, $clientSecret, $authCode, $redirectUri, $subdomain);
        $contact1 = new AmoContact([
            'name' => $data['name'],
            'responsible_user_id' => 10485414,
        ]);
        $contact1->setCustomFields([
            '1' => [[
                'value' => $data['phone'],
                'enum'  => 'WORK'
            ]],
            '2' => [[
                'value' => $data['email'],
                'enum'  => 'WORK'
            ]]
        ]);
        $contactId = $contact1->save();
        $lead1 = new AmoLead([
            'name'                => 'Сделка тест 2',
            'responsible_user_id' => 10485414,
            'pipeline'            => ['id' => 7614782],
            'sale'                => $data['price'],
        ]);
        $lead1->addContacts($contactId);
        $leadId = $lead1->save();
    }
}
