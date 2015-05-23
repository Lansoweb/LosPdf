<?php
/**
 * Abstract Renderer file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\View\Renderer;

use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use LosPdf\View\Model\PdfModel;

/**
 * Abstract Renderer class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
abstract class AbstractRenderer implements Renderer
{
    protected $engine = null;
    protected $resolver;
    protected $renderer;
    protected $model;
    protected $html = null;

    public function setRenderer(Renderer $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    abstract protected function doRender();
    abstract protected function doPrepare($model, $values);
    abstract protected function doRenderToString(PdfModel $model);
    abstract protected function doRenderToFile(PdfModel $model, $fileName);

    public function prepare($model, $values)
    {
        if ($this->html === null) {
            $this->model = $model;
            $this->doPrepare($model, $values);
        }
    }

    public function render($model, $values = null)
    {
        $this->prepare($model, $values);

        return $this->doRender();
    }

    public function renderToString(PdfModel $model, $values = null)
    {
        $this->prepare($model, $values);

        return $this->doRenderToString($model);
    }

    public function renderToFile(PdfModel $model, $fileName, $values = null)
    {
        $this->prepare($model, $values);

        return $this->doRenderToFile($model, $fileName);
    }

    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    protected function getOption($name, $default)
    {
        return $this->model->getOption($name, $default);
    }
}
