<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   
    public function testAPICoinDeskHistoricalBPIDataValidDate()
    {

        $base_url = env("APP_URL", "http://local.bitcoin-api.com");
    	$api_base_url = $base_url."/api/";

        $start = "2021-01-01";
        $end   = "2021-02-20";   
        $url   = $api_base_url."coindesk/historical_bpi_data?start=".$start."&end=".$end;
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    public function testAPICoinDeskHistoricalBPIDataInvalidDate()
    {

        // This test must pass and api should return 500
        $start   = "2021-02-20";
        $end 	 = "2021-01-01";   
        $url     = "http://local.bitcoin-api.com/api/coindesk/historical_bpi_data?start=".$start."&end=".$end;
        $response = $this->get($url);
        $response->assertStatus(500);
    }
}
