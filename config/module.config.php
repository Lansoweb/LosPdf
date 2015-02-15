<?php
return [
    'view_manager' => [
        'strategies' => [
            'ViewPdfStrategy'
        ]
    ],
    'service_manager' => [
        'factories' => [
            'ViewPdfRender' => 'LosPdf\Model\ViewPdfRender',
            'ViewPdfStrategy' => 'LosPdf\Model\ViewPdfStrategy'
        ],
    ]
];
