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

use Aura\Intl\Translator as IntlTranslator;
use Aura\Filter\TranslatorInterface as FilterTranslatorInterface;

/**
 * 
 * Implements separated interfaces for packages.
 * 
 * @package FOA.Filter_Intl_Bundle
 * 
 */
class Translator extends IntlTranslator implements FilterTranslatorInterface
{
    // do nothing, just extend and implement
}
