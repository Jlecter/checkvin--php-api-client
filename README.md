# CheckVin API client

CONTENTS OF THIS FILE
---------------------

 * Updates
 * Description
 * Key packages / extensions
 * Installation
 * Usage
 
  UPDATES
------------

- **17.03.2023** - published version (<b>v0.1.0</b>) - added an ability to work with AutoCheck, Balance, Carfax.
- **16.08.2023** - published version (<b>v0.2.0</b>) - fixed curl close bug.
- **21.01.2024** - published version (<b>v0.3.0</b>) - added VehicleProvider.
 
  DESCRIPTION
------------

CheckVin API client is a package for a convenient working with <a href="https://apicheckvin.xyz">CheckVin</a> API.

  KEY PACKAGES / EXTENSIONS
------------

* php
* ext-curl
* ext-json

 INSTALLATION
------------

Run: composer require jlecter/checkvin-php-api-client

 USAGE
------------

1. Choose provider what do you need. Available now:
- AutocheckDataProvider
- BalanceDataProvider
- CarfaxDataProvider
- VehicleDataProvider

2. Use it by passing inside your API key and calling available methods.

3. Get a response object with such available methods:
- "isSuccess" (returns true/false depends on response)
- "getData" (returns empty array while error response)
- "getError" (returns object while error response, null while success)
