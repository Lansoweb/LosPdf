<?php
return [
    'view_manager' => [
        'strategies' => [
            'ViewPdfStrategy',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ViewPdfRenderer' => 'LosPdf\Model\ViewPdfRenderer',
            'ViewPdfStrategy' => 'LosPdf\Model\ViewPdfStrategy',
        ],
    ],
];
