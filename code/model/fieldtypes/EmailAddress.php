<?php

class EmailAddress extends Varchar
{
    private static $casting = array(
        'HiddenEmailAddress' => 'HTMLText',
    );

    /**
     * Obfuscate all matching emails
     *
     * @return string
     */
    public function HiddenEmailAddress()
    {
        $originalString = $this->value;
        $encodedString = '';
        $nowCodeString = '';
        $originalLength = strlen($this->value);
        for ($i = 0; $i < $originalLength; ++$i) {
            $encodeMode = rand(1, 2); // Switch encoding odd/even
            switch ($encodeMode) {
                case 1: // Decimal code
                    $nowCodeString = '&#'.ord($originalString[$i]).';';
                    break;
                case 2: // Hexadecimal code
                    $nowCodeString = '&#x'.dechex(ord($originalString[$i])).';';
                    break;
                default:
                    return 'ERROR: wrong encoding mode.';
            }
            $encodedString .= $nowCodeString;
        }

        return $encodedString;
    }

    public function BreakAtSymbol()
    {
        return str_replace("@", "@<wbr>", $this->value);
    }


    /**
     * @see DBField::scaffoldFormField()
     *
     * @param string $title (optional)
     * @param array $params (optional)
     *
     * @return EmailField | NullableField
     */
    public function scaffoldFormField($title = null, $params = null)
    {
        if (!$this->nullifyEmpty) {
            return NullableField::create(EmailField::create($this->name, $title));
        } else {
            return EmailField::create($this->name, $title);
        }
    }
}
