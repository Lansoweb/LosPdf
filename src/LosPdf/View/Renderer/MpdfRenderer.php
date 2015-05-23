<?php
/**
 * Mpdf Renderer file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\View\Renderer;

use mPDF;
use LosPdf\View\Model\PdfModel;

/**
 * Mpdf Renderer class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
final class MpdfRenderer extends AbstractRenderer
{
    public function getEngine()
    {
        if ($this->engine === null) {
            $this->engine = new mPDF();
        }

        return $this->engine;
    }

    protected function doRender()
    {
        return $this->getEngine()->Output();
    }

    protected function doPrepare($model, $values)
    {
        $this->html = $this->renderer->render($model, $values);

        $paperOrientation = $this->getOption(PdfModel::PAPER_ORIENTATION, PdfModel::ORIENTATION_PORTRAIT);
        $paperSize = $this->getOption(PdfModel::PAPER_SIZE, PdfModel::SIZE_A4);

        if (!is_array($paperSize)) {
            $format = strtolower($paperOrientation[0]);
            if ($format == 'l') {
                $paperSize = $paperSize.'-'.$format;
            }
        }

        $this->getEngine()->_setPageSize($paperSize, $paperOrientation);
        $this->getEngine()->WriteHTML($this->html);
    }

    protected function doRenderToString(PdfModel $model)
    {
        return $this->getEngine()->Output('', 'S');
    }

    protected function doRenderToFile(PdfModel $model, $fileName)
    {
        return $this->getEngine()->Output($fileName, 'F');
    }
}
