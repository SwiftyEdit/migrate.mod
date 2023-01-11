## migrate.mod - SwiftyEdit CMS Module

This addon will help you if ...

* you want switch from SQLite to MySQL or from MySQL to SQLite
* you want to import data from flatCore CMS

### How to change the Database

1. First, make sure you have the latest Versions installed (SwiftyEdit AND migrate.mod). Make a backup of your website and the database!
2. If you want to switch to MySQL, add your Database Configuration and click the "save data" button
3. If your MySQL Database is connected, you will see the "Add Basic MySQL Tables ..." Button. In Case you have custom columns, there will appear a Button for each Column.
4. Now import the User Data and all columns from content.sqlite

__Attention__ if you hit the "Generate config file" Button, you can not switch back to the SQLite Database. At least not via the ACP. You can of course delete the file config_database.php from the server. SwiftyEdit will try to use the SQLite database.