<?php
namespace LosPdf\View\Renderer;

use mPDF;

class MpdfRenderer extends AbstractRenderer
{
    public function getEngine()
    {
        if ($this->engine === null) {
            $this->engine = new mPDF();
        }
        return $this->engine;
    }

    public function doRender($html, $options = [])
    {
        $paperOrientation = $this->getOption('paperOrientation', 'portrait');
        $paperSize = $this->getOption('paperSize', 'a4');

        $format = strtolower($paperOrientation[0]);
        if ($format == 'l') {
            $paperSize = $paperSize.'-'.$format;
        }

        $mpdf = $this->getEngine();
        $mpdf->_setPageSize($paperSize, $paperOrientation);
        $mpdf->WriteHTML($html);

        return $mpdf->Output();
    }
}
