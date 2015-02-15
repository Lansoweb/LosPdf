<?php
namespace LosPdf\View\Render;

use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

abstract class AbstractRenderer implements Renderer
{
    protected $engine;
    protected $resolver;
    protected $renderer;
    protected $model;

    public function setRenderer(Renderer $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function getRenderer()
    {
        return $this->renderer;
    }

    abstract public function doRender($html);

    public function render($model, $values = null)
    {
        $this->model = $model;
        $html = $this->renderer->render($model, $values);

        return $this->doRender($html);
    }

    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;

        return $this;
    }

    private function getOption($name, $default)
    {
        return $model->getOption($name, $default);
    }
}
