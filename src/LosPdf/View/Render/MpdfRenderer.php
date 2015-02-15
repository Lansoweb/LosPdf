<?php
namespace LosPdf\View\Render;

use mPDF;

class MpdfRenderer extends AbstractRenderer
{
    public function getEngine()
    {
        return new mPDF();
    }

    public function doRender($html, $options = [])
    {
        $paperOrientation = $this->getOption('paperOrientation','portrait');
        $paperSite = $this->getOption('paperSize','a4');

        $format = strtolower($paperOrientation[0]);
        if ($format == 'l') {
            $paperSize = $paperSize.'-'.$format;
        }

        $mpdf = $this->pdf;
        $mpdf->_setPageSize($paperSize, $paperOrientation);
        $mpdf->WriteHTML($html);

        return $mpdf->Output();
    }
}
