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

use Aura\Intl\Translator as IntlTranslator;
use Aura\Filter\TranslatorInterface as FilterTranslatorInterface;

/**
 * 
 * Implements separated interfaces for packages.
 * 
 * @package Aura.Framework
 * 
 */
class Translator extends IntlTranslator implements FilterTranslatorInterface
{
    // do nothing, just extend and implement
}
