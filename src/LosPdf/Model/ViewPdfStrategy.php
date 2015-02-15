<?php
namespace LosPdf\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LosPdf\View\Strategy\PdfStrategy;

class ViewPdfStrategy implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pdfRenderer = $serviceLocator->get('ViewPdfRender');

        return new PdfStrategy($pdfRenderer);
    }
}
