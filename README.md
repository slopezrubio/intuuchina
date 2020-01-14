# README

<img src="http://intuuchina.meinsusseichhornchen.org/./storage/images/logo.png" style="text-align: center">

<h2>Shared Hosting Deployment

<p>
    First, upload all the files inside the root project barring <code>\vendor</code>, <code>\node_modules</code>, and <code>\public</code>
</p>
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
<p>
    Create a public folder in the root directory of the shared hosting (this is up to you, it can be wherever you want).
</p>
<p>
    Compile and minify all the assets files before uploading them in the created folder:
</p>
<pre>
    npm run production
</pre>
<p>
    Copy the files of the <code>\public</code> folder and paste them inside the recently created folder. 
</p>
<p>
    Through a SSH Shell connected to the shared host pointing to your project root directory:
</p>
<pre>
    cd intuuchina
</pre>
<p>
    <a href="https://laravel.com/docs/5.8/deployment#autoloader-optimization">Optimize Composer's autoloader class</a> by typing
</p>
<pre>
    // If no alias is provided type
    php composer.phar install --optimize-autoloader --no-dev
</pre>
<p>
    Modify <code>.env</code> file accordingly to your database and host server:
</p>
<pre>
    DB_CONNECTION=
    DB_HOST=
    DB_PORT=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
</pre>
<p>
    Upload the modified file.
</p>
<p>
    Once that is done, make sure to reset Laravel's config as to cache the new configuration parameters.
</p>
<pre>
    php artisan config:cache
</pre>



