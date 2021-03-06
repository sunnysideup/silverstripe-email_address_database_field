# Email Address Database Field

A database field specifically for email addresses.

## Usage in model

```php

    MyClass extends DataObject
    {
        private static $db = [
            "MyEmail" => "EmailAddress"
        ];
    }
```

## Usage in templates
 
```html
    $MyEmail.HiddenEmailAddress
```


# Example

Adding a tab to the CMS page where emails can be added in a GridField.

## Definition of the classes

```php
    class Page extends SiteTree
    {

        private static $db = [
            'Email' => 'EmailAddress'
        ];

        /**
         * CMS Fields
         * @return FieldList
         */
        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            $fields->addFieldToTab(
                'Root.Emails',
                EmailField::create(
                    'Email',
                    'Email'
                )
            );
            return $fields;
        }

    }


```

## Template file

```html
    <a href="mailto:$Email.HiddenEmailAddress">$Email.HiddenEmailAddress</a>
```

# Credits

Big thank you to [Ralph Slooten](https://github.com/axllent) for the inspiration.
