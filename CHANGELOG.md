# Version 26.1.1

## Bugfixes

* Fix issue: Remove the tier price for all products that are available through the fired listner
  * Define a new method `addPrimarySkuToRowPkMapping` to map the SKU with the primary SKU of the row

## Features

* none

# Version 26.1.0

## Bugfixes

* Fix stock status in legacy mode since Magento 2.4.4
    * Extend Interface `ProductBunchProcessorInterface` with method `persistStockItemStatus()`

## Features

* none

# Version 26.0.0

## Bugfixes

* Fixed invalid behaviour of #PAC-307: Add fallback for URL key to value of default store view when initial import has been done without store view rows

## Features

* Refactoring deprecated classes. see https://github.com/techdivision/import-cli-simple/blob/master/UPGRADE-4.0.0.md
* Add techdivision/import-product-variant#22
* Add default configuration for tier price import
* Add missing operation `general/catalog_product/add-update.msi` to `ee/catalog_product_inventory/add-update` shortcut to also process the MSI artefact
* Add missing validation for min_qty, min_sale_qty, max_sale_qty, notify_stock_qty, qty_increments, weight fields
* Add PAC-299: create validation callback for sku relations for grouped, configurables and bundles
* PAC-541: Update composer with php Version ">=^7.3"

# Version 25.0.1

## Bugfixes

* Fixed techdivision/import-product#156

## Features

* None

# Version 25.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-product 24.* version as dependency

# Version 24.1.0

## Bugfixes

* None

## Features

* Add #PAC-72: Extend dedicated CLI command to delete existing videos (professional + enterprise edition)
* Add #PAC-75: Extend dedicated CLI command to replace existing videos (professional + enterprise edition)

# Version 24.0.1

## Bugfixes

* Fixed invalid subject initialization

## Features

* None

# Version 24.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-product 23.* version as dependency

# Version 23.0.0

## Bugfixes

* None

## Features

* Add #PAC-130

# Version 22.0.0

## Bugfixes

* None

## Features

* Add #PAC-47

# Version 21.0.2

## Bugfixes

* Fixed invalid JSON configuration file

## Features

* None

# Version 21.0.1

## Bugfixes

* None

## Features

* Add default configuration for media + images file dirctory

# Version 21.0.0

## Bugfixes

* None

## Features

* Add #PAC-73
* Switch to latest techdivision/import-product 21.* version as dependency

# Version 20.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 15.* and techdivision/import-product 20.* version as dependency
* Replace old default observer configuration for MSI sources, if inventory_source_items column is missing

# Version 19.0.3

## Bugfixes

* Fixed invald invokation of operation general/catalog_categor/children-count

## Features

* None

# Version 19.0.2

## Bugfixes

* None

## Features

* Extract dev autoloading

# Version 19.0.1

## Bugfixes

* Fixed issue with delta import when SKUs of simples, that are related with grouped, are in database but will not be loaded

## Features

* None

# Version 19.0.0

## Bugfixes

* None

## Features

* Fixed techdivision/import-product-ee#57

# Version 18.0.0

## Bugfixes

* None

## Features

* Refactor URL key handling
* Add techdivision/import#162
* Add techdivision/import-cli-simple#216
* Add techdivision/import-configuration-jms#25
* Remove unnecessary identifiers from configuration
* Switch to latest techdivision/import-ee 14.* and techdivision/import-product 19.* version as dependency

# Version 17.0.0

## Bugfixes

* Fixed techdivision/import-category-ee#34

## Features

* Switch to latest techdivision/import-product 18.* version as dependency

# Version 16.0.0

## Bugfixes

* Switch to latest techdivision/import-ee 13.* and techdivision/import-product 17.* version as dependency

## Features

* None

# Version 15.0.1

## Bugfixes

* Fixed invalid alias for DI alias import_product_ee.observer.composite.bundle.replace

## Features

* None

# Version 15.0.0

## Bugfixes

* None

## Features

* Remove unnecessary dedicated default product import configuration file for Magento 2.3.2
* Switch to latest techdivision/import-ee 12.* and techdivision/import-product 16.* version as dependency

# Version 14.0.0

## Bugfixes

* None

## Features

* Add new generic SKU to row ID mapping observer
* Extend addSkuRowIdMapping with a new optional rowId param
* Switch to latest techdivision/import-product 15.* version as dependency

# Version 13.0.4

## Bugfixes

* None

## Features

* Extend clean-up-empty-columns configuration by price specifc columns

# Version 13.0.3

## Bugfixes

* Fixed invalid Magento Version in default configuration file for Magento 2.3.2

## Features

* None

# Version 13.0.2

## Bugfixes

* None

## Features

* Add new version specific configuration and Syfmony DI configuration files for Magento 2.3.2

# Version 13.0.1

## Bugfixes

* None

## Features

* Remove unnecessary attribute set observer from price and inventory import Symfony DI configuration

# Version 13.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 11.* and techdivision/import-product 13.* version as dependency

# Version 12.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 10.* and techdivision/import-product 12.* version as dependency

# Version 11.0.1

## Bugfixes

* Fixed issue in DI configuration leading to invalid cache configuration

## Features

* None

# Version 11.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 9.0.* and techdivision/import-product 11.0.* version as dependency

# Version 10.0.1

## Bugfixes

* Fixed invalid persistProduct() method for replace operation by remove unnecessary observer

## Features

* None

# Version 10.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 8.0.* and techdivision/import-product 10.0.* version as dependency

# Version 9.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 7.0.* and techdivision/import-product 9.0.* version as dependency

# Version 8.0.3

## Bugfixes

* Fixed invalid DI name
* Fixed issue with invalid bundle composite observer configuration

## Features

* None

# Version 8.0.2

## Bugfixes

* Remove invalid pre-import configuration node

## Features

* None

# Version 8.0.1

## Bugfixes

* Update default configuration files with listeners

## Features

* None

# Version 8.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-ee 6.0.* and techdivision/import-product 8.0.* version as dependency
* Replace DI specific ActionInterfaces with generic ActionInterface in EeProductBunchProcessor

# Version 7.0.1

## Bugfixes

* None

## Features

* Update default configuration for grouped product import
* Refactor default configuration, replace the import_product_link.observer.link.update with import_product_link.observer.link for update operation

# Version 7.0.0

## Bugfixes

* None

## Features

* Added techdivision/import-cli-simple#198

# Version 6.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import-product 6.0.* version as dependency

# Version 5.0.0

## Bugfixes

* None

## Features

* Switch to latest techdivision/import 6.0.* version as dependency

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
