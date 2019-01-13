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
}
