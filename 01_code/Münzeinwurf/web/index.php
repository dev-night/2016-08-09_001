<?php
/**
 * Created by solutionDrive GmbH
 * User: Matthias Alt <alt@solutiondrive.de>
 * Date: 09.08.16
 * Time: 20:00
 */

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;
// ... definitions

$app->post('/geldannahme/transaction', function (\Symfony\Component\HttpFoundation\Request $request) {
    $transactionFileManager = new \devnight\geldannahme\TransactionFileManager();
    $transactionIdGenerator = new \devnight\geldannahme\TransactionIdGenerator();

    $transactionManager = new \devnight\geldannahme\TransactionManager($transactionIdGenerator, $transactionFileManager);

    $id = $transactionManager->startTransaction();
    return new \Symfony\Component\HttpFoundation\JsonResponse('"status": "ok", "transaction-id": "'.$id.'"', 200);
});

$app->post('geldannahme/transaction/{id}/charge-money', function (\Symfony\Component\HttpFoundation\Request $request, $id) {
    $transactionFileManager = new \devnight\geldannahme\TransactionFileManager();
    $transactionIdGenerator = new \devnight\geldannahme\TransactionIdGenerator();

    $amount = $request->request->get('amount');
    $currency = $request->request->get('currency');

    $transactionManager = new \devnight\geldannahme\TransactionManager($transactionIdGenerator, $transactionFileManager);
    $transactionManager->loadTransaction($id);
    $transactionManager->updateTransaction($amount, $currency);
    return new \Symfony\Component\HttpFoundation\JsonResponse('"status": "ok"', 200);
});


$app->run();