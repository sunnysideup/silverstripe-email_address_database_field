2020-04-17 08:40

# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/ss3/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/ss3/upgrades/upgradeto4/email_address_database_field/code  --root-dir=/var/www/ss3/upgrades/upgradeto4 --write -vvv
Writing changes for 0 files
Running post-upgrade on "/var/www/ss3/upgrades/upgradeto4/email_address_database_field/code"
[2020-04-17 20:40:30] Applying ApiChangeWarningsRule to EmailAddress.php...
[2020-04-17 20:40:30] Applying UpdateVisibilityRule to EmailAddress.php...
Writing changes for 0 files
✔✔✔
# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/ss3/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/ss3/upgrades/upgradeto4/email_address_database_field/code  --root-dir=/var/www/ss3/upgrades/upgradeto4 --write -vvv
Writing changes for 0 files
Running post-upgrade on "/var/www/ss3/upgrades/upgradeto4/email_address_database_field/code"
[2020-04-17 21:01:37] Applying ApiChangeWarningsRule to EmailAddress.php...
[2020-04-17 21:01:37] Applying UpdateVisibilityRule to EmailAddress.php...
Writing changes for 0 files
✔✔✔