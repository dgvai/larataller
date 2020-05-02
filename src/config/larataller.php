<?php 

    return [

        /**
         * LARATALLER CONFIGURATION
         * --------------------------------------
         * Configure you application installer
         * before you deploy the installer.
         * 
         */

        'php' => [
            /**
             * MINIMUM PHP VERSION
             * --------------------------------------
             * Define the minimum php verison 
             * required for you application
             * 
             */

            'min' => '7.3.0',

            /**
             * REQUIRED PHP EXTENSIONS
             * --------------------------------------
             * Define here which extensions are
             * required for your application.
             * 
             */

            'exts' => [
                'tokenizer',
                'json',
                'mbstring',
                'openssl',
                'dom',
                'libxml',
                'pdo',
                'phar',
                'xml',
                'xmlwriter',
                'curl',
                'gd',
                'memcached',
                'pcntl',
                'posix',
                'fileinfo',
                'ftp',
            ],
        ],


        'apache' => [
            'mods' => [
                'mod_rewrite',
            ],
        ],

        /**
         * CHECK FOR SYMLINK
         * --------------------------------------
         * If your migration contains the artisan
         * command of storage:link , or any 
         * symbolic link operation, then you 
         * might need to check if your hosting/system
         * service supports creating symlinks
         * 
         */

        'symlink' => false,

        /**
         * PERFORM MIGRATION?
         * --------------------------------------
         * Does you application runs migration 
         * to setup your database?
         * 
         */

        'migration' => true,

        /**
         * SQL FILE NAME
         * --------------------------------------
         * If your application does not like
         * migration to setup db, and you want
         * to use .sql file to upload to DB
         * to setup, define its name here.
         * 
         * It should be placed inside "public/install/mysqlsite_db.sql"
         * directory.
         * 
         * example: 'sql' => 'mysqlsite_db.sql'
         * 
         */

        'sql' => null, 

        /**
         * EXTRA ENV DATA
         * --------------------------------------
         * If you want to setup some more 
         * env attribute during setup time,
         * place them bellow here.
         * 
         */

        'extra' => [
            [
                'key' => 'MAIL_HOST',
                'title' => 'SMTP Mail Host'
            ],
            [
                'key' => 'MAIL_PORT',
                'title' => 'SMTP Mail Port'
            ],
            [
                'key' => 'MAIL_USERNAME',
                'title' => 'SMTP Mail Username'
            ],
            [
                'key' => 'MAIL_PASSWORD',
                'title' => 'SMTP Mail Password'
            ],
        ],

        /**
         * COMPLETE INSTALLATION REDIRECT
         * --------------------------------------
         * Redirect after completing the 
         * installation.
         * Provide route() name here.
         * 
         * example: home.dashboard
         */

        'redirect' => null,

        /**
         * INSTALLER CONFIGURATION 
         * --------------------------------------
         * Do not change these configs.
         */

        'installed' => env('LARATALLER_INSTALLED',false),

    ];