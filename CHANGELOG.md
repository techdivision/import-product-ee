# Version 4.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-product + techdivision/import-ee 4.0.* version as dependency

# Version 3.0.0

## Bugfixes

* None

## Features

* Compatibility for Magento 2.3.x

# Version 2.0.0

## Bugfixes

* None

## Features

* Compatibility for Magento 2.2.x

# Version 1.0.0

## Bugfixes

* None

## Features

* Move PHPUnit test from tests to tests/unit folder for integration test compatibility reasons

# Version 1.0.0-beta29

## Bugfixes

* None

## Features

* Add missing interfaces for actions and repositories
* Replace class type hints for EeProductBunchProcessor with interfaces

# Version 1.0.0-beta28

## Bugfixes

* Fixed invalid order of method invocation in tearDown() method

## Features

* None

# Version 1.0.0-beta27

## Bugfixes

* None

## Features

* Replace type hints for actions in product bunch processor with interfaces

# Version 1.0.0-beta26

## Bugfixes

* None

## Features

* Configure DI to passe event emitter to subjects constructor

# Version 1.0.0-beta25

## Bugfixes

* None

## Features

* Refactored DI + switch to new SqlStatementRepositories instead of SqlStatements

# Version 1.0.0-beta24

## Bugfixes

* Fixed invalid multiple product update

## Features

* Add product cache warmer functionality for optimized performance

# Version 1.0.0-beta23

## Bugfixes

* None

## Features

* Remove unncessary SQL statements for stock status create/update operation

# Version 1.0.0-beta22

## Bugfixes

* Add fix to ignore missing columns or columns with empty values when persisting inventory data

## Features

* None

# Version 1.0.0-beta21

## Bugfixes

* Fixed invalid Magento Edition in etc/techdivision-import-price.json

## Features

* None

# Version 1.0.0-beta20

## Bugfixes

* None

## Features

* Update configuration files for refactored file upload functionality

# Version 1.0.0-beta19

## Bugfixes

* None

## Features

* Refactor attribute import functionality

# Version 1.0.0-beta18

## Features

* None

## Bugfixes

* Add import_product_url_rewrite.observer.clear.url.rewrite to delete operation in techdivision-import.json

# Version 1.0.0-beta17

## Features

* None

## Bugfixes

* Removed invalid clear URL rewrite observer from default configuration file

# Version 1.0.0-beta16

## Features

* Completely remove URL rewrite handling

## Bugfixes

* Fixed invalid comparision in method EeBunchSubject::isUrlKeyOf()

# Version 1.0.0-beta15

## Features

* Update class EeProductBunchProcessor (for integration testing purposes)

## Bugfixes

* None

# Version 1.0.0-beta14

## Features

* None

## Bugfixes

* Fixed invalid URL rewrite creation

# Version 1.0.0-beta13

## Bugfixes

* Fixed invalid URL rewrite handling in replace operation

## Features

* None

# Version 1.0.0-beta12

## Bugfixes

* None

## Features

* Refactoring for better URL rewrite + attribute handling

# Version 1.0.0-beta11

## Bugfixes

* Fixed #75 [Invalid creation of product entities in a multi-store environment with replace operation](https://github.com/techdivision/import-product/issues/75)

## Features

* Add generic configurations for product price + inventory import
* Add generic LastEntityAndRowIdObserver that loads the product by the SKU found in the CSV file and set the row ID as lastRowId

# Version 1.0.0-beta10

## Bugfixes

* None

## Features

* Add custom system logger to default configuration

# Version 1.0.0-beta9

## Bugfixes

* None

## Features

* Refactor to optimize DI integration

# Version 1.0.0-beta8

## Bugfixes

* None

## Features

* Switch to new plugin + subject factory implementations

# Version 1.0.0-beta7

## Bugfixes

* None

## Features

* Use Robo for Travis-CI build process 
* Refactoring for new ConnectionInterface + SqlStatementsInterface

# Version 1.0.0-beta6

## Bugfixes

* None

## Features

* Remove archive directory from default configuration file

# Version 1.0.0-beta5

## Bugfixes

* None

## Features

* Refactoring Symfony DI integration

# Version 1.0.0-beta4

## Bugfixes

* Bugfix for invalid PK loading

## Features

* None

# Version 1.0.0-beta3

## Bugfixes

* None

## Features

* Add isUrlKeyOf() method to EeBunchSubject
* Add AttributeSetObserver to media workflow in generic configuration file etc/techdivision-import.json

# Version 1.0.0-beta2

## Bugfixes

* None

## Features

* Update default configuration file

# Version 1.0.0-beta1

## Bugfixes

* None

## Features

* Integrate Symfony DI functionality

# Version 1.0.0-alpha12

## Bugfixes

* None

## Features

* Refactoring for DI integration

# Version 1.0.0-alpha11

## Bugfixes

* None

## Features

* Stop processing attributes when attribute value is empty 

# Version 1.0.0-alpha10

## Bugfixes

* None

## Features

* Switch to EeAttributeObserverTrait

# Version 1.0.0-alpha9

## Bugfixes

* None

## Features

* Optimisations to use protected variables instead of methods

# Version 1.0.0-alpha8

## Bugfixes

* None

## Features

* Make observer methods protected instead of public

# Version 1.0.0-alpha7

## Bugfixes

* Fixed add-update operation issue that prevents importing new data

## Features

* None

# Version 1.0.0-alpha6

## Bugfixes

* None

## Features

* Implement add-update operation

# Version 1.0.0-alpha5

## Bugfixes

* None

## Features

* Switch to new create/delete naming convention

# Version 1.0.0-alpha4

## Bugfixes

* None

## Features

* Renaming processors because of changes in techdivision/import-product
* Add Robo.li composer dependeny + task configuration

# Version 1.0.0-alpha3

## Bugfixes

* None

## Features

* Move EeCleanUpObserver to Observers directory

# Version 1.0.0-alpha2

## Bugfixes

* None

## Features

* Refactoring to allow multiple prepared statements per CRUD processor instance

# Version 1.0.0-alpha1

## Bugfixes

* None

## Features

* Refactoring + Documentation to prepare for Github release