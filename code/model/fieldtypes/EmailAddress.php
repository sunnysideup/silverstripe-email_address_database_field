<?php

class EmailAddress extends Varchar
{
    private static $casting = array(
        'HiddenEmailAddress' => 'HTMLText',
    );

    /*
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

    /**
     * @see DBField::scaffoldFormField()
     */
    public function scaffoldFormField($title = null, $params = null) {
        if(!$this->nullifyEmpty) {
            return new NullableField(new EmailField($this->name, $title));
        } else {
            return new EmailField($this->name, $title);
        }
    }

}
