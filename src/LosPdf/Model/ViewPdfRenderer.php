<?php
/**
 * Pdf view renderer file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LosPdf\View\Renderer\MpdfRenderer;

/**
 * Pdf view renderer class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
class ViewPdfRenderer implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $viewResolver \Zend\View\Resolver\AggregateResolver */
        $viewResolver = $serviceLocator->get('ViewResolver');
        
        /* @var $viewRenderer \Zend\View\Renderer\PhpRenderer */
        $viewRenderer = $serviceLocator->get('ViewRenderer');

        if ($viewRenderer == null) {
            $viewManager = $serviceLocator->get('ViewManager');
            if (!method_exists($viewManager, 'getRenderer')) {
                throw new \RuntimeException('Unable to find a Renderer');
            }
            $viewRenderer = $viewManager->getRenderer();
        }

        //Later, this will be an option in config (mpdf, dompdf, etc)
        $pdfRenderer = new MpdfRenderer();
        $pdfRenderer->setResolver($viewResolver);
        $pdfRenderer->setRenderer($viewRenderer);

        return $pdfRenderer;
    }
}
