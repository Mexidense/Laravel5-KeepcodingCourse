<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Market;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarketTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function	testCreateMarket()
    {
        Market::create([
            'name' => 'name',
            'description' => 'description',
        ]);

        $markets = Market::getAllMarkets();

        $this->assertCount(1, $markets);
    }
    public function testCreateInactiveMarket()
    {
        Market::create([
            'name' => 'name1',
            'description' => 'description1',
            'active' => 1,
        ]);

        Market::create([
            'name' => 'name2',
            'description' => 'description2',
            'active' => 0,
        ]);
        
        $markets = Market::getAllMarkets();
        $this->assertCount(2, $markets);

        $activeMarkets = Market::getActiveMarkets();
        $this->assertCount(1, $activeMarkets);
    }

    public function testMarketsUsingFactories()
    {
        $activeMarketsAmount = 5;
        factory(Market::class, $activeMarketsAmount)->create();
        factory(Market::class)->create(['active' => 0]);

        $activeMarkets = Market::getActiveMarkets();
        $this->assertCount($activeMarketsAmount, $activeMarkets);

        $markets = Market::getAllMarkets();
        $this->assertCount(($activeMarketsAmount+1), $markets);
    }

    public function testFailValidation()
    {
        $input = [];

        $market = new Market();
        
        // Check that validator fails
        $this->assertFalse($market->validate($input));
        // Check all errors keys
        $this->assertArrayHasKey('name', $market->errors->getMessages());
        $this->assertArrayHasKey('description', $market->errors->getMessages());
    }

    public function testOkValidation()
    {
        $input = [
            'name'        => 'Chinese market',
            'acronym'     => 'CH',
            'description' => 'Nice market',
        ];
        $market = new Market($input);

        // Check that validator is ok
        $check = $market->validate($input);
        $this->assertTrue($check);

        // Check if this markets is saved on db.
        $market->save();
        $activeMarkets = Market::getActiveMarkets();
        $this->assertCount(1, $activeMarkets);
    }
}
