<?php

namespace Sunnysideup\EmailAddressDatabaseField\Model\Fieldtypes;

use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\NullableField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\FieldType\DBVarchar;

class EmailAddress extends DBVarchar
{
    private static $casting = [
        'HiddenEmailAddress' => 'HTMLText',
        'BreakAtSymbol' => 'HTMLText',
    ];

    public function prepValueForDB($value)
    {
        // emails are always lowercase.
        $value = trim(strtolower($value));

        return parent::prepValueForDB($value);
    }

    /**
     * Obfuscate all matching emails.
     */
    public function HiddenEmailAddress(?int $seed = 0): DBHTMLText
    {
        return $this->getHiddenEmailAddress($seed);
    }

    /**
     * Obfuscate all matching emails.
     */
    public function getHiddenEmailAddress(?int $seed = 0): DBHTMLText
    {
        $encodedString = $this->encodeValue($seed);

        /** @var DBHTMLText $var */
        $var = DBHTMLText::create_field('HTMLText', $encodedString);
        $var->RAW();

        return $var;
    }

    public function BreakAtSymbol(?bool $obfuscated = false): DBHTMLText
    {
        return $this->getBreakAtSymbol($obfuscated);
    }

    public function getBreakAtSymbol(?bool $obfuscated = false): DBHTMLText
    {
        $encodedString = $this->encodeValue();
        $value = $obfuscated ? $encodedString : $this->value;
        $encodedString = str_replace('@', '@<wbr>', (string) $value);
        /** @var DBHTMLText $var */
        $var = DBHTMLText::create_field('HTMLText', $encodedString);
        $var->RAW();

        return $var;
    }

    /**
     * @see DBField::scaffoldFormField()
     *
     * @param string $title  (optional)
     * @param array  $params (optional)
     *
     * @return EmailField|NullableField
     */
    public function scaffoldFormField($title = null, $params = null)
    {
        if (! $this->nullifyEmpty) {
            return NullableField::create(EmailField::create($this->name, $title));
        }

        return EmailField::create($this->name, $title);
    }

    protected function encodeValue(?int $seed = 0): string
    {
        $originalString = $this->value;
        $encodedString = '';
        $nowCodeString = '';
        $originalLength = strlen((string) $this->value);
        for ($i = 0; $i < $originalLength; ++$i) {
            $encodeMode = rand(1, 3); // Switch encoding odd/even
            switch ($encodeMode) {
                case 1: // Decimal code
                    $nowCodeString = '&#' . ord($originalString[$i]) . ';';

                    break;
                case 2: // Hexadecimal code
                    $nowCodeString = '&#x' . dechex(ord($originalString[$i])) . ';';

                    break;
                case 3: // normal
                    $nowCodeString = $originalString[$i];

                    break;
                default:
                    return 'ERROR: wrong encoding mode.';
            }

            $encodedString .= $nowCodeString;
        }

        return $encodedString;
    }
}
