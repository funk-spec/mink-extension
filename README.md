# funk-spec/mink-extension

     composer require --dev funk-spec/mink-extension

## What ?

A [funk-spec](https://github.com/funk-spec/funk-spec) extension that allows you to manipulate a mink instance
with your specs.

It will:

 - resolve constructor arguments typehinted with `Mink`
 - reset mink session before each example execution

## Why ?

For the same exact reason than the [behat's one](https://github.com/Behat/MinkExtension/) exists.  
Both are relying on the TestWork framework.  
Unfortunately, a lot of duplication exists between both, but no real tentative has been done yet
to abstract away the few differences.  

## How ?

In your funk.yml:

```yml
default:
    autoload:
        tests: '%paths.base%'

    suites:
        default: ~

    extensions:
        Behat\MinkExtension\ServiceContainer\MinkExtension:
            base_url:  'http://example.com'
            sessions:
                firefox:
                    selenium2:
                        capabilities:
                            browserName: firefox
                chrome:
                    selenium2:
                        capabilities:
                            browserName: chrome

        FunkSpec\Extension\Mink\Extension: ~

    suites:
        firefox: { mink_session: firefox }
        chrome: { mink_session: chrome }
```

Now your spec classes can receive a Mink instance:

```php
<?php

namespace tests\UI;

use Behat\Mink\Mink;

final class MinkSpec implements \Funk\Spec
{
    private $mink;

    public function __construct(Mink $mink)
    {
        $this->mink = $mink;
    }

    public function it_uses_mink()
    {
        var_dump($this->mink->getSession()->getDriver()->getWebDriverSession()->capabilities());
    }
}
