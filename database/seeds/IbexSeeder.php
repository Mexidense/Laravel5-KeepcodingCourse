<?php

use App\Market;
use App\Stock;
use Illuminate\Database\Seeder;

class IbexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $market = Market::create([
            'name'        => 'IBEX35',
            'description' => 'Mercado continuo español',
        ]);
        $market_id = $market->getKey();

        $stocks = [
            'ABE'  => 'Abertis',
            'ANA'  => 'Acciona',
            'ACX'  => 'Acerinox',
            'ACS'  => 'ACS',
            'AENA' => 'Aena',
            'AMS'  => 'Amadeus',
            'MTS'  => 'Acelormittal',
            'BBVA' => 'BBVA',
            'BKIA' => 'Bankia',
            'BKT'  => 'Bankinter',
            'CABK' => 'Caixabank',
            'CLNX' => 'Cellnex Telecom',
            'DIA'  => 'Día',
            'ENG'  => 'Enagas',
            'ELE'  => 'Endesa',
            'FER'  => 'Ferrovial',
            'GAM'  => 'Gamesa',
            'GAS'  => 'Gas Natural',
            'GRF'  => 'Grifols',
            'IAG'  => 'IAG Group',
            'IBE'  => 'Iberdrola',
            'ITX'  => 'Inditex',
            'IDR'  => 'Indra Sistemas',
            'COL'  => 'Inmobiliaria Colonial',
            'MAP'  => 'Mapfre',
            'TL5'  => 'Mediaset España',
            'MEL'  => 'Meliá Hotels',
            'MRL'  => 'Merlín',
            'REE'  => 'Red Electrica',
            'REP'  => 'Repsol',
            'SAB'  => 'Sabadell',
            'SAN'  => 'Santander',
            'TRE'  => 'Técnicas Reunidas',
            'TEF'  => 'Teléfonica',
            'VIS'  => 'Viscofan',
        ];

        foreach ($stocks as $acronym => $stockName) {
            Stock::create([
                'name'      => $stockName,
                'acronym'   => $acronym,
                'market_id' => $market_id,
            ]);
        }
    }
}
