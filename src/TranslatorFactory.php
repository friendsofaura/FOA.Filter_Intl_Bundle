<?php
/**
 * 
 * This file is part of the Aura project for PHP.
 * 
 * @package FOA.Filter_Intl_Bundle
 * 
 * @license http://opensource.org/licenses/bsd-license.php BSD
 * 
 */
namespace FOA\Filter_Intl_Bundle;

use Aura\Intl\TranslatorFactory as IntlTranslatorFactory;

/**
 * 
 * A factory to create framework translators.
 * 
 * @package FOA.Filter_Intl_Bundle
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
    protected $class = 'FOA\Filter_Intl_Bundle\Translator';
}
