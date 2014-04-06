<?php
/**
 * 
 * This file is part of the Aura project for PHP.
 * 
 * @package Aura.Framework
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace Aura\Filter_Intl_Bundle;

use Aura\Intl\TranslatorFactory as IntlTranslatorFactory;

/**
 * 
 * A factory to create framework translators.
 * 
 * @package Aura.Framework
 * 
 */
class TranslatorFactory extends IntlTranslatorFactory
{
    /**
     * 
     * The class to create for new instances.
     * 
     * @var string
     * 
     */
    protected $class = 'Aura\Filter_Intl_Bundle\Translator';
}
