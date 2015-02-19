<?php
namespace LosPdf\View\Model;

use Zend\View\Model\ViewModel;

class PdfModel extends ViewModel
{
    protected $options = [
        'paperSize' => 'A4',
        'paperOrientation' => 'portrait',
        'basePath' => '/',
        'fileName' => 'file',
    ];

    protected $captureTo = null;

    protected $terminate = true;
}
