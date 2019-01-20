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
        $this->assertCount($activeMarketsAmount+1, $markets);
    }

}
