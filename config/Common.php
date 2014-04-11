<?php
namespace FOA\Filter_Intl_Bundle\_Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Common extends Config
{
    public function define(Container $di)
    {
        // override the factory for translator locator
        $di->params['Aura\Intl\TranslatorLocator']['factory'] = $di->lazyNew('FOA\Filter_Intl_Bundle\TranslatorFactory');
    }
    
    public function modify(Container $di)
    {
    }
}
