# IntuuChina Site

![Sample Logo](https://github.com/slopezrubio/intuuchina/blob/main/sample_logo.png?raw=true)

![Sample Website Screenshot](https://github.com/slopezrubio/intuuchina/blob/main/sample_website.png?raw=true)

### Shared Hosting Deployment (1&1 IONOS)
First, upload all the files inside the root project barring `\vendor`, `\node_modules`, and `\public`
<pre>
    |-- intuuchina
        |- app
        |- bootstrap
        |- config
        |- database
        |- resources
        |- routes
        |- storage
        |- tests
        .editorconfig
        .env
        .gitattributes
        .gitignore
        artisan
        composer.json
        composer.phar
        package.json
        phpunit.xml
        server.php
        webpack.mix.js
        yarn.lock
</pre>

Create a `public` folder in the root directory of the shared hosting. Take into account that the public folder is going to be granted with different permissions than the rest of the files within the project, so `public` should not be inside the whole application. Take the following structure to apply, for instance:

<pre>
    |-- <b>public_html</b>
    |-- intuuchina
        |- app
        |- bootstrap
        |- config
        |- database
        |- resources
        |- routes
        |- storage
        |- tests
        .editorconfig
        .env
        .gitattributes
        .gitignore
        artisan
        composer.json
        composer.phar
        package.json
        phpunit.xml
        server.php
        webpack.mix.js
        yarn.lock
</pre>

From your local repository compile and minify all the assets files before uploading them in the `public`created folder:

<pre>
    npm run production
</pre>

Copy the files of your local repository of the `public` folder and paste them inside the recently created folder.

Through a SSH connected to the shared host (use PUTTY for instance) pointing to its root directory type the following to reach the application folder (`intuuchina`):

<pre>
    cd intuuchina
</pre>

Install composer and [optimize Composer's autoloader class](https://laravel.com/docs/5.8/deployment#autoloader-optimization) by typing:
   
<pre>
    // If no alias is provided type
    php composer.phar install --optimize-autoloader --no-dev
</pre>

Modify `.env` file accordingly to your provided database credentials and host server configuration:

<pre>
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
</pre>

Upload the modified `.env`file.

Once done, make sure to reset Laravel's config as to cache the new configuration parameters:

<pre>
    php artisan config:cache
</pre>
