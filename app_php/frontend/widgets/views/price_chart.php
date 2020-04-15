<?php

use dosamigos\chartjs\ChartJs;

/**
 * @var array $dataset
 */
?>

<?php
try {
    echo ChartJs::widget([
        'type' => 'line',
        'options' => [
            'height' => 300,
            'width' => 300
        ],
        'data' => [
            'labels' => $dataset['labels'],
            'datasets' => [
                [
                    'backgroundColor' => "rgba(255,99,132,0.2)",
                    'borderColor' => "rgba(255,99,132,1)",
                    'pointBackgroundColor' => "rgba(255,99,132,1)",
                    'pointBorderColor' => "#fff",
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "rgba(255,99,132,1)",
                    'data' => $dataset['data'],
                ]
            ]
        ]
    ]);
} catch (Exception $e) {
    throw $e;
}
?>
