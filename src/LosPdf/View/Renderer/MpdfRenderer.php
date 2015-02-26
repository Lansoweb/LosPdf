<?php
namespace LosPdf\View\Renderer;

use mPDF;
use LosPdf\View\Model\PdfModel;

final class MpdfRenderer extends AbstractRenderer
{
    public function getEngine()
    {
        if ($this->engine === null) {
            $this->engine = new mPDF();
        }
        return $this->engine;
    }

    protected function doRender($html, $options = [])
    {
        return $this->getEngine()->Output();
    }

    protected function doPrepare($model, $values)
    {
        $this->html = $this->renderer->render($model, $values);

        $paperOrientation = $this->getOption('paperOrientation', 'portrait');
        $paperSize = $this->getOption('paperSize', 'a4');

        $format = strtolower($paperOrientation[0]);
        if ($format == 'l') {
            $paperSize = $paperSize.'-'.$format;
        }

        $this->getEngine()->_setPageSize($paperSize, $paperOrientation);
        $this->getEngine()->WriteHTML($this->html);
    }

    protected function doRenderToString(PdfModel $model)
    {
        return $this->getEngine()->Output('','S');
    }

    protected function doRenderToFile(PdfModel $model, $fileName)
    {
        return $this->getEngine()->Output($fileName,'F');
    }
}
