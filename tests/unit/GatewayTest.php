<?php

namespace Omnipay\BitPay\Tests;

use Omnipay\BitPay\Gateway;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public $gateway;

    private $testMode = true;
    private $token = 'CFJCZH3VitcEER9Uybx8LMvkPsSWzpSWvN4vhNEJp47b';
    private $transactionId = 'test12345test';
    private $description = 'Test completePurchase description';
    private $currency = 'USD';
    private $amount = '12.46';

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setToken($this->token);
        $this->gateway->setTestMode($this->testMode);
    }

    public function testGateway()
    {
        $this->assertSame($this->token, $this->gateway->getToken());
        $this->assertSame($this->testMode, $this->gateway->getTestMode());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(['transactionId' => $this->transactionId]);

        $this->assertSame($this->testMode, $request->getTestMode());
        $this->assertSame($this->transactionId, $request->getTransactionId());
    }

    public function testPurchase()
    {
        $request = $this->gateway->purchase([
            'transactionId' => $this->transactionId,
            'description' => $this->description,
            'currency' => $this->currency,
            'amount' => $this->amount,
        ]);

        $this->assertSame($this->transactionId, $request->gettransactionid());
        $this->assertSame($this->description, $request->getDescription());
        $this->assertSame($this->currency, $request->getCurrency());
        $this->assertSame($this->amount, $request->getAmount());
    }
}
