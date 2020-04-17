2020-04-17 08:40

# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/ss3/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /var/www/ss3/upgrades/upgradeto4/email_address_database_field  --root-dir=/var/www/ss3/upgrades/upgradeto4 --write -vvv
Writing changes for 2 files
Running upgrades on "/var/www/ss3/upgrades/upgradeto4/email_address_database_field"
[2020-04-17 20:40:11] Applying RenameClasses to _config.php...
[2020-04-17 20:40:11] Applying ClassToTraitRule to _config.php...
[2020-04-17 20:40:11] Applying RenameClasses to EmailAddressDatabaseFieldTest.php...
[2020-04-17 20:40:11] Applying ClassToTraitRule to EmailAddressDatabaseFieldTest.php...
[2020-04-17 20:40:11] Applying RenameClasses to EmailAddress.php...
[2020-04-17 20:40:11] Applying ClassToTraitRule to EmailAddress.php...
modified:	tests/EmailAddressDatabaseFieldTest.php
@@ -1,4 +1,6 @@
 <?php
+
+use SilverStripe\Dev\SapphireTest;

 class EmailAddressDatabaseFieldTest extends SapphireTest
 {

modified:	code/Model/Fieldtypes/EmailAddress.php
@@ -2,9 +2,13 @@

 namespace Sunnysideup\EmailAddressDatabaseField\Model\Fieldtypes;

-use DBVarchar;
-use NullableField;
-use EmailField;
+
+
+
+use SilverStripe\Forms\EmailField;
+use SilverStripe\Forms\NullableField;
+use SilverStripe\ORM\FieldType\DBVarchar;
+


 class EmailAddress extends DBVarchar

Writing changes for 2 files
✔✔✔