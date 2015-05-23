<?php
/**
 * Pdf view strategy file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\Model;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use LosPdf\View\Strategy\PdfStrategy;

/**
 * Pdf view strategy class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
class ViewPdfStrategy implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pdfRenderer = $serviceLocator->get('ViewPdfRenderer');

        return new PdfStrategy($pdfRenderer);
    }
}
