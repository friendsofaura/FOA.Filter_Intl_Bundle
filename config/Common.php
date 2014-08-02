<?php
namespace FOA\Filter_Intl_Bundle\_Config;

use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Intl\Package;

class Common extends Config
{
    public function define(Container $di)
    {        
        /**
         * Services
         */
        $di->set('intl_package_factory', $di->lazyNew('Aura\Intl\PackageFactory'));
        $di->set('intl_translator_locator', $di->lazyNew('Aura\Intl\TranslatorLocator'));

        /**
         * Aura\Intl\FormatterLocator
         */
        $di->params['Aura\Intl\FormatterLocator']['registry'] = [
            'basic' => $di->lazyNew('Aura\Intl\BasicFormatter'),
            'intl'  => $di->lazyNew('Aura\Intl\IntlFormatter'),
        ];

        /**
         * Aura\Intl\TranslatorLocator
         */
        $di->params['Aura\Intl\TranslatorLocator'] = [
            'locale' => 'en_US',
            'factory' => $di->lazyNew('Aura\Intl\TranslatorFactory'),
            'formatters' => $di->lazyNew('Aura\Intl\FormatterLocator'),
            'packages' => $di->lazyNew('Aura\Intl\PackageLocator'),
        ];
    }

    public function modify(Container $di)
    {
        $this->addIntl($di);
    }

    public function addIntl(Container $di)
    {
        $translators = $di->get('intl_translator_locator');
        // get the package locator
        $packages = $translators->getPackages();

        // place into the locator for Vendor.Package
        $packages->set('Aura.Filter', 'en_US', function() {
            // create a US English message set
            $package = new Package;
            $package->setMessages([
                "FILTER_RULE_FAILURE_IS_ALNUM" => "Please use only alphanumeric characters.",
                "FILTER_RULE_FAILURE_IS_NOT_ALNUM" => "Please do not use only alphanumeric characters.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ALNUM" => "Please leave blank, or use only alphanumeric characters.",
                "FILTER_RULE_FAILURE_FIX_ALNUM" => "Could not sanitize to only alphanumeric characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ALNUM" => "Could not sanitize to a blank or only alphanumeric characters.",

                "FILTER_RULE_FAILURE_IS_ALPHA" => "Please use only alphabetic characters.",
                "FILTER_RULE_FAILURE_IS_NOT_ALPHA" => "Please do not use only alphabetic characters.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ALPHA" => "Please leave blank, or use only alphabetic characters.",
                "FILTER_RULE_FAILURE_FIX_ALPHA" => "Could not sanitize to only alphabetic characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ALPHA" => "Could not sanitize to a blank or only alphabetic characters.",

                "FILTER_RULE_FAILURE_IS_ANY" => "This field did not pass any of the sub-rules.",
                "FILTER_RULE_FAILURE_IS_NOT_ANY" => "This field should not have passed any of the sub-rules.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ANY" => "Please leave blank, or change so it passes one of the sub-rules.",
                "FILTER_RULE_FAILURE_FIX_ANY" => "Could not sanitize this field.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ANY" => "Could not sanitize this field.",

                "FILTER_RULE_FAILURE_IS_BETWEEN" => "Please use a value between {min} and {max}.",
                "FILTER_RULE_FAILURE_IS_NOT_BETWEEN" => "Please do not use a value between {min} and {max}.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BETWEEN" => "Please leave blank, or use a value between {min} and {max}.",
                "FILTER_RULE_FAILURE_FIX_BETWEEN" => "Could not sanitize this field to a value between {min} and {max}.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BETWEEN" => "Could not sanitize this field to blank or a value between {min} and {max}",

                "FILTER_RULE_FAILURE_IS_BLANK" => "Please leave this blank.",
                "FILTER_RULE_FAILURE_IS_NOT_BLANK" => "Please do not leave this blank.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BLANK" => "Please leave this blank.",
                "FILTER_RULE_FAILURE_FIX_BLANK" => "Could not sanitize to blank.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BLANK" => "Could not sanitize to blank.",

                "FILTER_RULE_FAILURE_IS_BOOL" => "Please use a boolean (true/false) value.",
                "FILTER_RULE_FAILURE_IS_NOT_BOOL" => "Please do not use a boolean (true/false) value.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BOOL" => "Please leave blank, or use a boolean (true/false) value.",
                "FILTER_RULE_FAILURE_FIX_BOOL" => "Could not sanitize to a boolean (true/false) value.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BOOL" => "Could not sanitize to blank or a boolean (true/false) value.",

                "FILTER_RULE_FAILURE_IS_CREDIT_CARD" => "Please use a valid credit card number.",
                "FILTER_RULE_FAILURE_IS_NOT_CREDIT_CARD" => "Please do not use a credit card number.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_CREDIT_CARD" => "Please leave blank, or use a valid credit card number.",
                "FILTER_RULE_FAILURE_FIX_CREDIT_CARD" => "Could not sanitize to a credit card number.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_CREDIT_CARD" => "Could not sanitize to blank or a credit card number.",

                "FILTER_RULE_FAILURE_IS_DATE_TIME" => "Please use a valid date/time value in the format '{format}'.",
                "FILTER_RULE_FAILURE_IS_NOT_DATE_TIME" => "Please do not use a date/time value in the format '{format}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_DATE_TIME" => "Please leave blank or use a valid date/time value in the format '{format}'.",
                "FILTER_RULE_FAILURE_FIX_DATE_TIME" => "Could not sanitize to a date/time value in the format '{format}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_DATE_TIME" => "Could not sanitize to blank or a date/time value in the format '{format}'.",

                "FILTER_RULE_FAILURE_IS_EMAIL" => "Please use a valid email address.",
                "FILTER_RULE_FAILURE_IS_NOT_EMAIL" => "Please do not use a valid email address.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EMAIL" => "Please leave blank or use a valid email address.",
                "FILTER_RULE_FAILURE_FIX_EMAIL" => "Could not sanitize to an email address.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EMAIL" => "Could not sanitize to blank or a valid email address.",

                "FILTER_RULE_FAILURE_IS_EQUAL_TO_FIELD" => "Please use a value equal to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_IS_NOT_EQUAL_TO_FIELD" => "Please do not use a value equal to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EQUAL_TO_FIELD" => "Please leave blank or use a value equal to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_FIX_EQUAL_TO_FIELD" => "Could not sanitize to a value equal to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EQUAL_TO_FIELD" => "Could not sanitize to blank or a value equal to the field '{other_field}'.",

                "FILTER_RULE_FAILURE_IS_EQUAL_TO_VALUE" => "Please use the value '{value}'.",
                "FILTER_RULE_FAILURE_IS_NOT_EQUAL_TO_VALUE" => "Please do not use the value '{value}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EQUAL_TO_VALUE" => "Please leave blank or use the value '{value}'.",
                "FILTER_RULE_FAILURE_FIX_EQUAL_TO_VALUE" => "Could not sanitize to '{value}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EQUAL_TO_VALUE" => "Could not sanitize to blank or '{value}'.",

                "FILTER_RULE_FAILURE_IS_FLOAT" => "Please use a decimal number.",
                "FILTER_RULE_FAILURE_IS_NOT_FLOAT" => "Please do not use a decimal number.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_FLOAT" => "Please leave blank or use a decimal number.",
                "FILTER_RULE_FAILURE_FIX_FLOAT" => "Could not sanitize to a decimal number.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_FLOAT" => "Could not sanitize to blank or a decimal number.",

                "FILTER_RULE_FAILURE_IS_IN_KEYS" => "Please use one of the following: {keys}",
                "FILTER_RULE_FAILURE_IS_NOT_IN_KEYS" => "Please do not use the following: {keys}",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IN_KEYS" => "Please leave blank or use one of the following: {keys}",
                "FILTER_RULE_FAILURE_FIX_IN_KEYS" => "Could not sanitize to an acceptable key.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IN_KEYS" => "Could not sanitize to blank or an acceptable key.",

                "FILTER_RULE_FAILURE_IS_INT" => "Please use a whole number.",
                "FILTER_RULE_FAILURE_IS_NOT_INT" => "Please do not use a whole number.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_INT" => "Please leave blank or use a whole number.",
                "FILTER_RULE_FAILURE_FIX_INT" => "Could not sanitize to a whole number.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_INT" => "Could not sanitize to blank or a whole number.",

                "FILTER_RULE_FAILURE_IS_IN_VALUES" => "Please use one of the following: {values}",
                "FILTER_RULE_FAILURE_IS_NOT_IN_VALUES" => "Please do not use the following: {values}",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IN_VALUES" => "Please leave blank or use one of the following: {values}",
                "FILTER_RULE_FAILURE_FIX_IN_VALUES" => "Could not sanitize to an acceptable value.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IN_VALUES" => "Could not sanitize to blank or an acceptable value.",

                "FILTER_RULE_FAILURE_IS_IPV4" => "Please use a valid IPv4 address.",
                "FILTER_RULE_FAILURE_IS_NOT_IPV4" => "Please do not use a valid IPv4 address.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IPV4" => "Please leave blank or use a valid IPv4 address.",
                "FILTER_RULE_FAILURE_FIX_IPV4" => "Could not sanitize to an IPv4 address.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IPV4" => "Could not sanitize to blank or an IPv4 address.",

                "FILTER_RULE_FAILURE_IS_LOCALE" => "Please use a valid locale code.",
                "FILTER_RULE_FAILURE_IS_NOT_LOCALE" => "Please do not use a valid locale code.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_LOCALE" => "Please leave blank or use a valid locale code.",
                "FILTER_RULE_FAILURE_FIX_LOCALE" => "Could not sanitize to a valid locale code.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_LOCALE" => "Could not sanitize to blank or a valid locale code.",

                "FILTER_RULE_FAILURE_IS_MAX" => "Please use a maximum value of '{max}'.",
                "FILTER_RULE_FAILURE_IS_NOT_MAX" => "Please use a value greater than '{max}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_MAX" => "Please leave blank or use a maximum value of '{max}'.",
                "FILTER_RULE_FAILURE_FIX_MAX" => "Could not sanitize to a maximum value of '{max}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_MAX" => "Could not sanitize to blank or a maximum value of '{max}'.",

                "FILTER_RULE_FAILURE_IS_MIN" => "Please use a minimum value of '{min}'.",
                "FILTER_RULE_FAILURE_IS_NOT_MIN" => "Please use a value less than '{min}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_MIN" => "Please leave blank or use a minimum value of '{min}'.",
                "FILTER_RULE_FAILURE_FIX_MIN" => "Could not sanitize to a minimum value of '{min}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_MIN" => "Could not sanitize to blank or a minimum value of '{min}'.",

                "FILTER_RULE_FAILURE_IS_REGEX" => "Please use a value that matches the pattern '{expr}'.",
                "FILTER_RULE_FAILURE_IS_NOT_REGEX" => "Please use a value that does not match the pattern '{expr}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_REGEX" => "Please leave blank or use a value that matches the pattern '{expr}'.",
                "FILTER_RULE_FAILURE_FIX_REGEX" => "Could not sanitize to the pattern '{expr}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_REGEX" => "Could not sanitize to blank or the pattern '{expr}'.",

                "FILTER_RULE_FAILURE_IS_STRICT_EQUAL_TO_FIELD" => "Please use a value identical to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_IS_NOT_STRICT_EQUAL_TO_FIELD" => "Please use a value that is not identical to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRICT_EQUAL_TO_FIELD" => "Please leave blank or use a value identical to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_FIX_STRICT_EQUAL_TO_FIELD" => "Could not sanitize to a value identical to the field '{other_field}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRICT_EQUAL_TO_FIELD" => "Could not sanitize to blank or a value identical to the field '{other_field}'.",

                "FILTER_RULE_FAILURE_IS_STRICT_EQUAL_TO_VALUE" => "Please use a value identical to '{value}'.",
                "FILTER_RULE_FAILURE_IS_NOT_STRICT_EQUAL_TO_VALUE" => "Please do not use a value identical to '{value}'.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRICT_EQUAL_TO_VALUE" => "Please leave blank or use a value identical to '{value}'.",
                "FILTER_RULE_FAILURE_FIX_STRICT_EQUAL_TO_VALUE" => "Could not sanitize to a value identical to '{value}'.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRICT_EQUAL_TO_VALUE" => "Could not sanitize to blank or a value identical to '{value}'.",

                "FILTER_RULE_FAILURE_IS_STRING" => "Please use a string of text.",
                "FILTER_RULE_FAILURE_IS_NOT_STRING" => "Please do not use a string of text.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRING" => "Please leave blank or use a string a text.",
                "FILTER_RULE_FAILURE_FIX_STRING" => "Could not sanitize to a string of text.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRING" => "Could not sanitize to blank or a string of text.",

                "FILTER_RULE_FAILURE_IS_STRLEN" => "Please use {len} character(s).",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN" => "Please do not use {len} character(s).",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN" => "Please leave blank or use {len} characters.",
                "FILTER_RULE_FAILURE_FIX_STRLEN" => "Could not sanitize to {strlen} characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN" => "Could not sanitize to blank or {strlen} characters.",

                "FILTER_RULE_FAILURE_IS_STRLEN_BETWEEN" => "Please use between {min} and {max} characters.",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_BETWEEN" => "Please do not use between {min} and {max} characters.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_BETWEEN" => "Please leave blank or use between {min} and {max} characters.",
                "FILTER_RULE_FAILURE_FIX_STRLEN_BETWEEN" => "Could not sanitize to between {min} and {max} characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_BETWEEN" => "Could not sanitize to blank or between {min} and {max} characters.",

                "FILTER_RULE_FAILURE_IS_STRLEN_MAX" => "Please use no more than than {max} character(s).",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_MAX" => "Please use more than {max} character(s).",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_MAX" => "Please leave blank or use no more than {max} character(s).",
                "FILTER_RULE_FAILURE_FIX_STRLEN_MAX" => "Could not sanitize to no more than {max} characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_MAX" => "Could not sanitize to blank or no more than {max} characters.",

                "FILTER_RULE_FAILURE_IS_STRLEN_MIN" => "Please use at least {min} character(s).",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_MIN" => "Please use no more than {min} character(s).",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_MIN" => "Please leave blank or use at least {min} character(s).",
                "FILTER_RULE_FAILURE_FIX_STRLEN_MIN" => "Could not sanitize to at least {min} character(s).",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_MIN" => "Could not sanitize to blank or at least {min} character(s).",

                "FILTER_RULE_FAILURE_IS_TRIM" => "Please omit whitepspace padding.",
                "FILTER_RULE_FAILURE_IS_NOT_TRIM" => "Please use whitepspace padding.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_TRIM" => "Please leave blank or omit whitespace padding.",
                "FILTER_RULE_FAILURE_FIX_TRIM" => "Could not sanitize whitespace padding.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_TRIM" => "Could not sanitize to blank or remove whitespace padding.",

                "FILTER_RULE_FAILURE_IS_UPLOAD" => "Please upload a file.",
                "FILTER_RULE_FAILURE_IS_NOT_UPLOAD" => "Please do not upload a file.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_UPLOAD" => "Please leave blank or upload a file.",
                "FILTER_RULE_FAILURE_FIX_UPLOAD" => "Could not sanitize uploaded file.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_UPLOAD" => "Could not sanitize to blank or uploaded file.",
                "FILTER_RULE_ERR_UPLOAD_INI_SIZE" => "The uploaded file exceeds the upload_max_filesize in php.ini.",
                "FILTER_RULE_ERR_UPLOAD_FORM_SIZE" => "The uploaded file exceeds the MAX_FILE_SIZE in the HTML form.",
                "FILTER_RULE_ERR_UPLOAD_PARTIAL" => "The uploaded file was only partially uploaded.",
                "FILTER_RULE_ERR_UPLOAD_NO_FILE" => "No file was uploaded.",
                "FILTER_RULE_ERR_UPLOAD_NO_TMP_DIR" => "No temporory directory to save uploaded file.",
                "FILTER_RULE_ERR_UPLOAD_CANT_WRITE" => "Failed to write uploaded file to disk.",
                "FILTER_RULE_ERR_UPLOAD_EXTENSION" => "A PHP extension stopped the file upload.",
                "FILTER_RULE_ERR_UPLOAD_UNKNOWN" => "An unknown error prevented the upload.",
                "FILTER_RULE_ERR_UPLOAD_IS_UPLOADED_FILE" => "The file is not an uploaded file.",
                "FILTER_RULE_ERR_UPLOAD_ARRAY_KEYS" => "The upload array is malformed.",

                "FILTER_RULE_FAILURE_IS_URL" => "Please enter a valid URL.",
                "FILTER_RULE_FAILURE_IS_NOT_URL" => "Please do not enter a valid URL.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_URL" => "Please leave blank or enter a valid URL.",
                "FILTER_RULE_FAILURE_FIX_URL" => "Could not sanitize to a valid URL.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_URL" => "Could not sanitize to blank or a valid URL.",

                "FILTER_RULE_FAILURE_IS_WORD" => "Please use only word characters.",
                "FILTER_RULE_FAILURE_IS_NOT_WORD" => "Please do not use only word characters.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_WORD" => "Please leave blank or use only word characters.",
                "FILTER_RULE_FAILURE_FIX_WORD" => "Could not sanitize to only word characters.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_WORD" => "Could not sanitize to blank or only word characters.",

                "FILTER_RULE_FAILURE_IS_ISBN" => "Please use valid ISBN.",
                "FILTER_RULE_FAILURE_IS_NOT_ISBN" => "Please do not use ISBN.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ISBN" => "Please leave blank or use valid ISBN.",
                "FILTER_RULE_FAILURE_FIX_ISBN" => "Could not sanitize to valid ISBN.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ISBN" => "Could not sanitize to blank or valid ISBN.",
            ]);
            return $package;
        });

        // place into the locator for a Vendor.Package
        $packages->set('Aura.Filter', 'de_DE', function() {
            // a Brazilian Portuguese message set
            $package = new Package;
            $package->setMessages([
                "FILTER_RULE_FAILURE_IS_ALNUM" => "Bitte nur alphanumerische Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_ALNUM" => "Bitte nicht nur alphanumerische Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ALNUM" => "Bitte frei lassen oder nur alphanumerische Zeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_ALNUM" => "Umwandlung in nur alphanumerische Zeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ALNUM" => "Umwandlung in leeren Wert oder nur alphanumerische Zeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_ALPHA" => "Bitte nur Buchstaben verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_ALPHA" => "Bitte nicht nur Buchstaben verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ALPHA" => "Bitte frei lassen oder nur Buchstaben verwenden.",
                "FILTER_RULE_FAILURE_FIX_ALPHA" => "Umwandlung zu nur Buchstaben nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ALPHA" => "Umwandlung in leeren Wert oder nur Buchstaben nicht möglich.",

                "FILTER_RULE_FAILURE_IS_ANY" => "Dieses Feld hat keine der Sub-Regel bestanden.",
                "FILTER_RULE_FAILURE_IS_NOT_ANY" => "Dieses Feld hätte keine der Sub-Regel bestehen sollen.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ANY" => "Bitte frei lassen oder so verändern, dass die Sub-Regeln bestanden werden.",
                "FILTER_RULE_FAILURE_FIX_ANY" => "Umwandlung dieses Feldes nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ANY" => "Umwandlung dieses Feldes nicht möglich.",

                "FILTER_RULE_FAILURE_IS_BETWEEN" => "Bitte einen Wert zwischen {min} und {max} eingeben.",
                "FILTER_RULE_FAILURE_IS_NOT_BETWEEN" => "Bitte einen Wert eingeben, der nicht zwischen {min} und {max} liegt.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BETWEEN" => "Bitte frei lassen oder einen Wert zwischen {min} und {max} eingeben.",
                "FILTER_RULE_FAILURE_FIX_BETWEEN" => "Umwandlung zu einem Wert zwischen {min} und {max} nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BETWEEN" => "Umwandlung in einen leeren Wert oder einem Wert zwischen {min} und {max} nicht möglich.",

                "FILTER_RULE_FAILURE_IS_BLANK" => "Bitte dieses Feld leer lassen.",
                "FILTER_RULE_FAILURE_IS_NOT_BLANK" => "Bitte dieses Feld nicht leer lassen.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BLANK" => "Bitte dieses Feld leer lassen.",
                "FILTER_RULE_FAILURE_FIX_BLANK" => "Umwandlung zu leerem Wert nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BLANK" => "Umwandlung zu leerem Wert nicht möglich.",

                "FILTER_RULE_FAILURE_IS_BOOL" => "Bitte einen booleschen Wert (true/false) verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_BOOL" => "Bitte keinen booleschen Wert (true/false) verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_BOOL" => "Bitte frei lassen oder einen booleschen Wert (true/false) verwenden.",
                "FILTER_RULE_FAILURE_FIX_BOOL" => "Umwandlung in einen booleschen Wert (true/false) nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_BOOL" => "Umwandlung in einen leeren Wert oder einen booleschen Wert (true/false) nicht möglich.",

                "FILTER_RULE_FAILURE_IS_CREDIT_CARD" => "Bitte eine gültige Kreditkarten-Nummer verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_CREDIT_CARD" => "Bitte keine gültige Kreditkarten-Nummer verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_CREDIT_CARD" => "Bitte frei lassen oder eine gültige Kreditkarten-Nummer verwenden.",
                "FILTER_RULE_FAILURE_FIX_CREDIT_CARD" => "Umwandlung in eine Kreditkarten-Nummer nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_CREDIT_CARD" => "Umwandlung in einen leeren Wert oder eine Kreditkarten-Nummer nicht möglich.",

                "FILTER_RULE_FAILURE_IS_DATE_TIME" => "Bitte ein gültiges Datum/Uhrzeit der Form '{format}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_DATE_TIME" => "Bitte kein gültiges Datum/Uhrzeit der Form '{format}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_DATE_TIME" => "Bitte frei lassen oder ein gültiges Datum/Uhrzeit der Form '{format}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_DATE_TIME" => "Umwandlung in ein gültiges Datum/Uhrzeit der Form '{format}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_DATE_TIME" => "Umwandlung in einen leeren Wert oder ein gültiges Datum/Uhrzeit der Form '{format}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_EMAIL" => "Bitte eine gültige E-Mail Adresse verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_EMAIL" => "Bitte keine gültige E-Mail Adresse verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EMAIL" => "Bitte frei lassen oder eine gültige E-Mail Adresse verwenden.",
                "FILTER_RULE_FAILURE_FIX_EMAIL" => "Umwandlung in eine gültige E-Mail Adresse nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EMAIL" => "Umwandlung in einen leeren Wert oder eine gültige E-Mail Adresse nicht möglich.",

                "FILTER_RULE_FAILURE_IS_EQUAL_TO_FIELD" => "Bitte einen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_EQUAL_TO_FIELD" => "Bitte keinen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EQUAL_TO_FIELD" => "Bitte frei lassen oder einen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_EQUAL_TO_FIELD" => "Umwandlung zu einem identischen Wert zu dem Feld '{other_field}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EQUAL_TO_FIELD" => "Umwandlung zu einem leeren oder identischen Wert zu dem Feld '{other_field}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_EQUAL_TO_VALUE" => "Bitte den Wert '{value}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_EQUAL_TO_VALUE" => "Bitte nicht den Wert '{value}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_EQUAL_TO_VALUE" => "Bitte frei lassen oder den Wert '{value}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_EQUAL_TO_VALUE" => "Umwandlung in den Wert '{value}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_EQUAL_TO_VALUE" => "Umwandlung in einen leeren Wert oder den Wert '{value}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_FLOAT" => "Bitte eine Dezimalzahl verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_FLOAT" => "Bitte keine Dezimalzahl verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_FLOAT" => "Bitte frei lassen oder eine Dezimalzahl verwenden.",
                "FILTER_RULE_FAILURE_FIX_FLOAT" => "Umwandlung in eine Dezimalzahl nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_FLOAT" => "Umwandlung in einen leeren Wert oder eine Dezimalzahl nicht möglich.",

                "FILTER_RULE_FAILURE_IS_IN_KEYS" => "Bitte einen der angegebene Schlüssel verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_IN_KEYS" => "Bitte keinen der angegebene Schlüssel verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IN_KEYS" => "Bitte frei lassen oder einen der angegebene Schlüssel verwenden.",
                "FILTER_RULE_FAILURE_FIX_IN_KEYS" => "Umwandlung in einen der angegebene Schlüssel nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IN_KEYS" => "Umwandlung in einen leeren Wert oder einen der angegebene Schlüssel nicht möglich.",

                "FILTER_RULE_FAILURE_IS_INT" => "Bitte eine Ganzzahl verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_INT" => "Bitte keine Ganzzahl verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_INT" => "Bitte frei lassen oder eine Ganzzahl verwenden.",
                "FILTER_RULE_FAILURE_FIX_INT" => "Umwandlung in eine Ganzzahl nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_INT" => "Umwandlung in einen leeren Wert oder eine Ganzzahl nicht möglich.",

                "FILTER_RULE_FAILURE_IS_IN_VALUES" => "Bitte einen der angegebenen Wert verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_IN_VALUES" => "Bitte keinen der angegebenen Wert verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IN_VALUES" => "Bitte frei lassen oder einen der angegebenen Wert verwenden.",
                "FILTER_RULE_FAILURE_FIX_IN_VALUES" => "Umwandlung in einen der angegebenen Wert nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IN_VALUES" => "Umwandlung in einen leeren Wert oder einen der angegebenen Wert nicht möglich.",

                "FILTER_RULE_FAILURE_IS_IPV4" => "Bitte eine gültige IPv4-Adresse verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_IPV4" => "Bitte keine gültige IPv4-Adresse verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_IPV4" => "Bitte frei lassen oder gültige IPv4-Adresse verwenden.",
                "FILTER_RULE_FAILURE_FIX_IPV4" => "Umwandlung in eine gültige IPv4-Adresse nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_IPV4" => "Umwandlung in einen leeren Wert oder eine gültige IPv4-Adresse nicht möglich.",

                "FILTER_RULE_FAILURE_IS_LOCALE" => "Bitte eine gültige Sprachkennung (z. B. de_DE, en_US) verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_LOCALE" => "Bitte keine gültige Sprachkennung (z. B. de_DE, en_US) verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_LOCALE" => "Bitte frei lassen oder eine gültige Sprachkennung (z. B. de_DE, en_US) verwenden.",
                "FILTER_RULE_FAILURE_FIX_LOCALE" => "Umwandlung in eine gültige Sprachkennung (z. B. de_DE, en_US) nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_LOCALE" => "Umwandlung in einen leeren Wert oder eine gültige Sprachkennung (z. B. de_DE, en_US) nicht möglich.",

                "FILTER_RULE_FAILURE_IS_MAX" => "Bitte maximal einen Wert von '{max}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_MAX" => "Bitte keinen Wert größer als '{max}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_MAX" => "Bitte frei lassen oder maximal einen Wert von '{max}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_MAX" => "Umwandlung in einen maximalen Wert von '{max}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_MAX" => "Umwandlung in einen leeren Wert oder einen maximalen Wert von '{max}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_MIN" => "Bitte mindestens einen Wert von '{min}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_MIN" => "Bitte eine Wert kleiner als '{min}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_MIN" => "Bitte frei lassen oder mindestens einen Wert von '{min}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_MIN" => "Umwandlung in einen Wert von mindestens '{min}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_MIN" => "Umwandlung in einen leeren Wert oder einen Wert von mindestens '{min}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_REGEX" => "Bitte einen Wert verwenden, der dem regulären Ausdruck '{expr}' entspricht.",
                "FILTER_RULE_FAILURE_IS_NOT_REGEX" => "Bitte einen Wert verwenden, der nicht dem regulären Ausdruck '{expr}' entspricht.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_REGEX" => "Bitte frei lassen oder einen Wert verwenden, der dem regulären Ausdruck '{expr}' entspricht.",
                "FILTER_RULE_FAILURE_FIX_REGEX" => "Umwandlung in einen Wert, der dem regulären Ausdruck '{expr}' entspricht, nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_REGEX" => "Umwandlung in einen leeren Wert oder einen Wert, der dem regulären Ausdruck '{expr}' entspricht, nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRICT_EQUAL_TO_FIELD" => "Bitte einen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRICT_EQUAL_TO_FIELD" => "Bitte keinen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRICT_EQUAL_TO_FIELD" => "Bitte frei lassen oder einen identischen Wert zu dem Feld '{other_field}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRICT_EQUAL_TO_FIELD" => "Umwandlung in einen identischen Wert zu dem Feld '{other_field} nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRICT_EQUAL_TO_FIELD" => "Umwandlung in einen leeren Wert oder einen identischen Wert zu dem Feld '{other_field} nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRICT_EQUAL_TO_VALUE" => "Bitte einen identischen Wert zu '{value}' verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRICT_EQUAL_TO_VALUE" => "Bitte keinen identischen Wert zu '{value}' verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRICT_EQUAL_TO_VALUE" => "Bitte frei lassen oder einen identischen Wert zu '{value}' verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRICT_EQUAL_TO_VALUE" => "Umwandlung in einen identischen Wert zu '{value}' nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRICT_EQUAL_TO_VALUE" => "Umwandlung in einen leeren Wert oder einen identischen Wert zu '{value}' nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRING" => "Bitte einen Text-String verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRING" => "Bitte keinen Text-String verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRING" => "Bitte frei lassen oder einen Text-String verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRING" => "Umwandlung in einen Text-String nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRING" => "Umwandlung in einen leeren Wert oder einen Text-String nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRLEN" => "Bitte {len} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN" => "Bitte keine {len} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN" => "Bitte frei lassen oder {len} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRLEN" => "Umwandlung zu {strlen} Zeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN" => "Umwandlung in einen leeren Wert oder zu {strlen} Zeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRLEN_BETWEEN" => "Bitte zwischen {min} und {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_BETWEEN" => "Bitte keine {min} bis {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_BETWEEN" => "Bitte frei lassen oder zwischen {min} und {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRLEN_BETWEEN" => "Umwandlung in einen Wert von {min} bis {max} Zeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_BETWEEN" => "Umwandlung in einen leeren oder Wert von {min} bis {max} Zeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRLEN_MAX" => "Bitte nicht mehr als {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_MAX" => "Bitte mehr als {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_MAX" => "Bitte frei lassen oder nicht mehr als {max} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRLEN_MAX" => "Umwandlung in einen Wert von nicht mehr als {max} Zeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_MAX" => "Umwandlung in einen leeren oder Wert von nicht mehr als {max} Zeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_STRLEN_MIN" => "Bitte mindestens {min} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_STRLEN_MIN" => "Bitte nicht mehr {min} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_STRLEN_MIN" => "Bitte frei lassen oder mindestens {min} Zeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_STRLEN_MIN" => "Umwandlung in einen Wert von mindestens {min} Zeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_STRLEN_MIN" => "Umwandlung in einen leeren oder Wert von mindestens {min} Zeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_TRIM" => "Bitte Leerzeichen am Anfang und Ende entfernen.",
                "FILTER_RULE_FAILURE_IS_NOT_TRIM" => "Bitte Leerzeichen am Anfang und Ende hinzufügen.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_TRIM" => "Bitte frei lassen oder Leerzeichen am Anfang und Ende entfernen.",
                "FILTER_RULE_FAILURE_FIX_TRIM" => "Entfernung von Leerzeichen am Anfang und Ende nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_TRIM" => "Umwandlung in einen leeren Wert oder Entfernung von Leerzeichen am Anfang und Ende nicht möglich.",

                "FILTER_RULE_FAILURE_IS_UPLOAD" => "Bitte eine Datei hochladen.",
                "FILTER_RULE_FAILURE_IS_NOT_UPLOAD" => "Bitte keine Datei hochladen.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_UPLOAD" => "Bitte frei lassen oder eine Datei hochladen.",
                "FILTER_RULE_FAILURE_FIX_UPLOAD" => "Umwandlung in eine hochzuladende Datei nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_UPLOAD" => "Umwandlung in einen leeren Wert oder eine hochzuladende Datei nicht möglich.",
                "FILTER_RULE_ERR_UPLOAD_INI_SIZE" => "Die hochgeladene Datei übersteigt den upload_max_filesize Wert in der php.ini.",
                "FILTER_RULE_ERR_UPLOAD_FORM_SIZE" => "Die hochgeladene Datei übersteigt den MAX_FILE_SIZE Wert in dem HTML Formular.",
                "FILTER_RULE_ERR_UPLOAD_PARTIAL" => "Die Datei wurde nur teilweise hochgeladen.",
                "FILTER_RULE_ERR_UPLOAD_NO_FILE" => "Es wurde keine Datei hochgeladen.",
                "FILTER_RULE_ERR_UPLOAD_NO_TMP_DIR" => "Kein temporäres Verzeichnis vorhanden, um die hochgeladene Datei zu speichern.",
                "FILTER_RULE_ERR_UPLOAD_CANT_WRITE" => "Die hochgeladene Datei konnte nicht auf der Festplatte gespeichert werden.",
                "FILTER_RULE_ERR_UPLOAD_EXTENSION" => "Eine PHP-Erweiterung hat das Hochladen der Datei verhindert.",
                "FILTER_RULE_ERR_UPLOAD_UNKNOWN" => "Es trat ein unbekannter Fehler beim Hochladen der Datei auf.",
                "FILTER_RULE_ERR_UPLOAD_IS_UPLOADED_FILE" => "Bei der Datei handelt es sich nicht um eine hochgeladene Datei.",
                "FILTER_RULE_ERR_UPLOAD_ARRAY_KEYS" => "Der Array des Hochladen-Vorgangs ist fehlerhaft formatiert.",

                "FILTER_RULE_FAILURE_IS_URL" => "Bitte eine gültige URL angeben.",
                "FILTER_RULE_FAILURE_IS_NOT_URL" => "Bitte keine gültige URL angeben.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_URL" => "Bitte frei lassen oder eine gültige URL angeben.",
                "FILTER_RULE_FAILURE_FIX_URL" => "Umwandlung in eine gültige URL nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_URL" => "Umwandlung in einen leeren Wert oder eine gültige URL nicht möglich.",

                "FILTER_RULE_FAILURE_IS_WORD" => "Bitte nur gültige Wortzeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_NOT_WORD" => "Bitte nicht nur gültige Wortzeichen verwenden.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_WORD" => "Bitte frei lassen oder nur gültige Wortzeichen verwenden.",
                "FILTER_RULE_FAILURE_FIX_WORD" => "Umwandlung in nur gültige Wortzeichen nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_WORD" => "Umwandlung in einen leeren Wert oder nur gültige Wortzeichen nicht möglich.",

                "FILTER_RULE_FAILURE_IS_ISBN" => "Bitte gültige ISBN angeben.",
                "FILTER_RULE_FAILURE_IS_NOT_ISBN" => "Bitte keine gültige ISBN angeben.",
                "FILTER_RULE_FAILURE_IS_BLANK_OR_ISBN" => "Bitte frei lassen oder gültige ISBN angeben.",
                "FILTER_RULE_FAILURE_FIX_ISBN" => "Umwandlung in eine gültige ISBN nicht möglich.",
                "FILTER_RULE_FAILURE_FIX_BLANK_OR_ISBN" => "Umwandlung in einen leeren Wert oder eine gültige ISBN nicht möglich.",
            ]);
            return $package;
        });
    }
}
