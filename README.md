#Email Address Database Field

A database field specifically for email addresses.

Usage in model
---


```php

    MyClass extends DataObject
    {
        $db = array("MyEmail" => "EmailAddress");
    }

```

 usage in templates
 ---
 ```html

    $MyEmail.HiddenEmailAddress.RAW
```

The `RAW` part is important.


# credits

Big thank you to [Ralph Slooten](https://github.com/axllent) for the inspiration.
