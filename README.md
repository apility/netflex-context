# Netflex Context

## Introduction
This library allows you to modify the core (NF class) to access information from other sites in a simple and effective manner.

It allows you to either permanently or temporarily fetch information from a different page.

For example scoped:

```php
use Netflex\Context\Manager;
use Netflex\Context\Context;

$externalSiteContext = Context::fromApiKeys("publicKey", "privateKey", "studentbergen");

Manager::inContext($externalSiteContext, function() {
  // Do Stuff here
});

```

Or more straight forward
```php
$baseContext = Manager::getCurrentContext();
$externalSiteContext = Context::fromApiKeys("publicKey", "privateKey", "studentbergen");

Manager::setContext($externalSiteContext);

// Do stuff

Manager::setContext($baseContext);
```