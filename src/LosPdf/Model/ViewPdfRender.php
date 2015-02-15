<?php
namespace LosPdf\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LosPdf\View\Render\MpdfRenderer;

class ViewPdfRender implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewManager = $serviceLocator->get('ViewManager');

        //Later, this will be an option in config (mpdf, dompdf, etc)
        $pdfRenderer = new MpdfRenderer();
        $pdfRenderer->setResolver($viewManager->getResolver());
        $pdfRenderer->setRenderer($viewManager->getRenderer());

        return $pdfRenderer;
    }
}
