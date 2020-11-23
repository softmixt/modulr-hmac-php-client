<?php

namespace Tests\Unit\Http\Middleware;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Http\Request;
use CrowdProperty\ModulrHmacPhpClient\Http\Middleware\VerifyModulrHmac;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerifyModulrHmacTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // set Carbon to use fixed datetime as "now" during these tests
        $knownDate = Carbon::parse('2020-11-01 12:12:23 GMT');
        Carbon::setTestNow($knownDate);
    }

    /**
     * A valid request, arriving at exact time as specified in Date header.
     *
     * @return void
     */
    public function testPassingRequest ()
    {
        $request = new Request;
        $request->headers->add([
            'Authorization' => 'Signature keyId="57502612d1bb2c0001000025fd53850cd9a94861507a5f7cca236882",algorithm="hmac-sha1",headers="date x-mod-nonce",signature="BPZ%2FIsFA0SQPLesj%2FPrHssUxl24%3D"',
            'Date' => '2020-11-01 12:12:23 GMT',
            'X-Mod-Nonce' => 'ABCD12345'
            ]);

        $middleware = new VerifyModulrHmac;

        $middleware->handle($request, function ($req) {
            $this->assertTrue(true);
        });
    }

    /**
     * A valid request, arriving a few seconds after date in Date header - but within allowed tolerance.
     *
     * @return void
     */
    public function testSlightlyOffTimeRequest ()
    {
        $request = new Request;
        $request->headers->add([
            'Authorization' => 'Signature keyId="57502612d1bb2c0001000025fd53850cd9a94861507a5f7cca236882",algorithm="hmac-sha1",headers="date x-mod-nonce",signature="BPZ%2FIsFA0SQPLesj%2FPrHssUxl24%3D"',
            'Date' => '2020-11-01 12:12:23 GMT',
            'X-Mod-Nonce' => 'ABCD12345'
            ]);

        // Set time that Carbon considers as present to 8 seconds after date in Date header
        Carbon::setTestNow(Carbon::parse('2020-11-01 12:12:31 GMT'));

        $middleware = new VerifyModulrHmac;

        $middleware->handle($request, function ($req) {
            $this->assertTrue(true);
        });
    }

    /**
     * An invalid request, arriving too many seconds after date in Date header - ie outside allowed tolerance.
     *
     * @return void
     */
    public function testTooFarOffTimeRequest ()
    {
        $request = new Request;
        $request->headers->add([
            'Authorization' => 'Signature keyId="57502612d1bb2c0001000025fd53850cd9a94861507a5f7cca236882",algorithm="hmac-sha1",headers="date x-mod-nonce",signature="BPZ%2FIsFA0SQPLesj%2FPrHssUxl24%3D"',
            'Date' => '2020-11-01 12:12:23 GMT',
            'X-Mod-Nonce' => 'ABCD12345'
            ]);

        // Set time that Carbon considers as present to 12 seconds after date in Date header
        Carbon::setTestNow(Carbon::parse('2020-11-01 12:12:35 GMT'));

        $middleware = new VerifyModulrHmac;

        $this->expectException(HttpException::class);

        $middleware->handle($request, function ($req) {
            // we shouldn't get here, so trigger failure if we do
            $this->assertTrue(false, "Fail: the request was allowed to continue");
        });
    }

    /**
     * Check incorrect nonce triggers exception
     *
     * @return void
     */
    public function testIncorrectNonce ()
    {
        $request = new Request;
        $request->headers->add([
            'Authorization' => 'Signature keyId="57502612d1bb2c0001000025fd53850cd9a94861507a5f7cca236882",algorithm="hmac-sha1",headers="date x-mod-nonce",signature="BPZ%2FIsFA0SQPLesj%2FPrHssUxl24%3D"',
            'Date' => '2020-11-01 12:12:23 GMT',
            'X-Mod-Nonce' => 'Wrong nonce'
            ]);

        $middleware = new VerifyModulrHmac;

        $this->expectException(HttpException::class);

        $middleware->handle($request, function ($req) {
            // we shouldn't get here, so trigger failure if we do
            $this->assertTrue(false, "Fail: the request was allowed to continue");
        });
    }

    /**
     * Check incorrect signature triggers failure.
     *
     * @return void
     */
    public function testIncorrectSignature ()
    {
        $request = new Request;
        $request->headers->add([
            'Authorization' => 'Signature keyId="57502612d1bb2c0001000025fd53850cd9a94861507a5f7cca236882",algorithm="hmac-sha1",headers="date x-mod-nonce",signature="wrong sig !"',
            'Date' => '2020-11-01 12:12:23 GMT',
            'X-Mod-Nonce' => 'ABCD12345'
            ]);

        $middleware = new VerifyModulrHmac;

        $this->expectException(HttpException::class);

        $middleware->handle($request, function ($req) {
            // we shouldn't get here, so trigger failure if we do
            $this->assertTrue(false, "Fail: the request was allowed to continue");
        });
    }
}
