<?php
/**
 * PdfStrategy file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf\View\Strategy;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\ViewEvent;
use LosPdf\View\Renderer\AbstractRenderer;
use LosPdf\View\Model\PdfModel;

/**
 * PdfStrategy class
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
class PdfStrategy implements ListenerAggregateInterface
{
    protected $listeners = [];

    protected $renderer;

    public function __construct(AbstractRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if ($model instanceof PdfModel) {
            return $this->renderer;
        }

        return;
    }

    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            return;
        }

        $result = $e->getResult();

        if (!is_string($result)) {
            return;
        }

        $response = $e->getResponse();
        $response->setContent($result);
        $response->getHeaders()->addHeaderLine('content-type', 'application/pdf');

        $fileName = $e->getModel()->getOption('filename');
        if (isset($fileName)) {
            if (substr($fileName, -4) != '.pdf') {
                $fileName .= '.pdf';
            }

            $response->getHeaders()->addHeaderLine(
                'Content-Disposition',
                'attachment; filename='.$fileName);
        }
    }
}
