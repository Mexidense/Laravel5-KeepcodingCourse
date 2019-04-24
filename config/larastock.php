<?php

return [
    'alphavantage_key'             => env('ALPHAVANTAGE_KEY', 'demo'),
    'alphavantage_base_url'        => 'https://www.alphavantage.co/query',
    'closing_values_method'        => 'TIME_SERIES_DAILY',
    'moving_average_values_method' => 'SMA',
    'intersection_margin'          => '0.1',

    'uptrend_message'              => 'Tendencia alcista. Corte al alza',
    'uptrend_correction_message'   => 'Corrección en la subida.',
    'downtrend_message'            => 'Tendencia bajista. Corte a la baja',
    'downtrend_correction_message' => 'Corrección en la bajada',
];
