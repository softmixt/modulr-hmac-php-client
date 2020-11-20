<?php

namespace Tests\Unit;

use Carbon\Carbon;
use CrowdProperty\ModulrHmacPhpClient\ModulrApi;
use Tests\TestCase;

class ModulrApiTest extends TestCase
{
    /**
     * Check new clients created get the current time set.
     *
     * So that request signatures are valid, rather than out of date if clients creating during long-running process
     * such as job handler.
     *
     * @return void
     */
    public function testClientsGetCurrentDateSet()
    {
        $client = new ModulrApi();

        $initialTime = Carbon::parse('2020-11-01 02:00:00 GMT');
        $laterTime   = Carbon::parse('2020-11-01 15:00:00 GMT');

        $client->setApiKey('abcde');
        $client->setHmacSecret('abcde');
        $client->setNonce('1234');
        $client->setTimezone('GMT');
        $client->setDate($initialTime);

        // Set "current" time (i.e. in test env), to the later time
        Carbon::setTestNow($initialTime);

        // Just for completeness, check the time returned initially, is exactly the time we set
        $initialPaymentsClient = $client->payments();
        $date = Carbon::parse($initialPaymentsClient->getApiClient()->getConfig()->getDefaultHeaders()["Date"]);
        $this->assertEquals(0, $date->diffInSeconds($initialTime));

        // Set "current" time (i.e. in test env), to the later time
        Carbon::setTestNow($laterTime);

        // get a new payments client
        $laterPaymentsClient = $client->payments();

        // Check that the later client has had the date refreshed as the later time
        $date = Carbon::parse($laterPaymentsClient->getApiClient()->getConfig()->getDefaultHeaders()["Date"]);
        $this->assertEquals(0, $date->diffInSeconds($laterTime));
    }
}
