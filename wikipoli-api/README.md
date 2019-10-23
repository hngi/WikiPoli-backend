# WikiPoli Backend

This is the backend repo for WikiPoli. If you want to contribute, create your own branch from here, work, commit and make a PR. Always make sure your local repo is in sync with the remote repo. 

If you're finding it difficult to get the right git command, use [gitexplorer](https://gitexplorer.com)


APPLICATON STRUCTURE
    ::::Helper Folder:::::
        This will contain static functions that can be called

    ::::API Folder:::::
        This will contain php files that will be consumed by the FrontEnd guys.

    The autoloader.php automatically includes all our Helpers class and all the classes in the helpers folder uses the Helper namespace.

EXTERNAL LIBRARY

    ::::Authentication:::::
        We will be using JWT for authentication,The firebase/php-jwt will be used for jwt



For the database connection,An example on how to connect to the database is in index.php
The db_connect function returns the connection resource.To input your database configuration,go to Helpers/Config.php and edit the protected array
