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

    /**
     * Obfuscate all matching emails
     *
     * @return DBHTMLText
     */
    public function HiddenEmailAddress(): DBHTMLText
    {
        return $this->getHiddenEmailAddress();
    }

    /**
     * Obfuscate all matching emails
     *
     * @return DBHTMLText
     */
    public function getHiddenEmailAddress(): DBHTMLText
    {
        $encodedString = $this->encodeValue();

        /** @var DBHTMLText */
        $var = DBHTMLText::create_field('HTMLText', $encodedString);
        $var->RAW();
        return $var;
    }

    /**
     *
     * @param  bool|null    $obfuscated
     * @return DBHTMLText
     */
    public function BreakAtSymbol(?bool $obfuscated = false): DBHTMLText
    {
        return $this->getBreakAtSymbol($obfuscated);
    }

    /**
     *
     * @param  bool|null    $obfuscated
     * @return DBHTMLText
     */
    public function getBreakAtSymbol(?bool $obfuscated = false): DBHTMLText
    {
        if ($obfuscated) {
            $value = ${$encodedString} = $this->encodeValue();
        } else {
            $value = $this->value;
        }
        $encodedString = str_replace('@', '@<wbr>', $value);
        /** @var DBHTMLText */
        $var = DBHTMLText::create_field('HTMLText', $encodedString);
        $var->RAW();

        return $var;
    }

    /**
     * @see DBField::scaffoldFormField()
     *
     * @param string $title (optional)
     * @param array $params (optional)
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

    protected function encodeValue(): string
    {
        $originalString = $this->value;
        $encodedString = '';
        $nowCodeString = '';
        $originalLength = strlen($this->value);
        for ($i = 0; $i < $originalLength; ++$i) {
            $encodeMode = rand(1, 2); // Switch encoding odd/even
            switch ($encodeMode) {
                case 1: // Decimal code
                    $nowCodeString = '&#' . ord($originalString[$i]) . ';';
                    break;
                case 2: // Hexadecimal code
                    $nowCodeString = '&#x' . dechex(ord($originalString[$i])) . ';';
                    break;
                default:
                    return 'ERROR: wrong encoding mode.';
            }
            $encodedString .= $nowCodeString;
        }
        return $encodedString;
    }
}
