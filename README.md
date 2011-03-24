LifestreamBundle for Symfony2
=============

Some bla bla.

Installation
-------

Make sure you have a `Cleverage` dir, if not create it:

    mkdir src/Cleverage

Add the bundle to the `src/` directory. If using
git, you can add it as submodules:

    git submodule add git@github.com:Cleverage/LifestreamBundle.git src/Cleverage/LifestreamBundle

Next, be sure to enable the bundle in your application kernel:

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'Cleverage'      => __DIR__.'/../src',
        // ...
    ));

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Cleverage\LifestreamBundle\CleverageLifestreamBundle(),
            // ...
        );
    }

Load the Cleverage_lifestream services in the DIC by simply adding the name of the extension :

        # app/config.yml
        cleverage_lifestream: ~

Then, import the routing rules if you want to display the provided view :

    # app/config/routing.yml
    lifestream:
        resource: '@CleverageLifestreamBundle/Resources/config/routing.yml'
        prefix: /lifestream

At this point you can access to the lifestream with the url: `http://yoursite.local/lifestream`.


You must provide the parameters like that.

    parameters:
        lifestream.lastfm.username: LALALA
        lifestream.lastfm.api_key: b25b959554ed76058ac220b7b2e0a026
        lifestream.flickr.user_id: oiezruzoeriuzer
        lifestream.flickr.api_key: 11111

TODO :

- create a Configuration Class and refactor the whole service configuration process