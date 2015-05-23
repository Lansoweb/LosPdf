<?php
/**
 * Module file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
namespace LosPdf;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

/**
 * Module file
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosPdf
 * @license    https://github.com/Lansoweb/LosPdf/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosPdf
 */
class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__.'/../../autoload_classmap.php',
            ],
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ ,
                ],
            ],
        ];
    }

    public function getConfig()
    {
        return include __DIR__.'/../../config/module.config.php';
    }
}
