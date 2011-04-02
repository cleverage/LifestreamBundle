LifestreamBundle for Symfony2
=============

Installation
-------

Add the bundle to the `src/` directory. If using
git, you can add it as submodules:

    git submodule add git@github.com:Cleverage/LifestreamBundle.git src/CleverAge/LifestreamBundle

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
            new CleverAge\LifestreamBundle\CleverageLifestreamBundle(),
            // ...
        );
    }

Load the Cleverage_lifestream services in the DIC by simply adding the name of the extension :

        # app/config.yml
        clever_age_lifestream: ~

Then, import the routing rules if you want to display the provided view :

        lifestream:
            resource: '@CleverAgeLifestreamBundle/Resources/config/routing.yml'
            prefix: /lifestream

At this point you can access to the lifestream with the url: `http://yoursite.local/lifestream`.

Configuration
-------

In your config.yml:

    clever_age_lifestream:
        apis:
            lastfm:
                class: CleverAge\Bundle\LifestreamBundle\ApiClient\Lastfm
                config:
                  username: XXX
                  api_key:  b25b959554ed76058ac220b7b2e0a026

You can add as many "apis" node as you like.

Todo
-------

- Work on the Flickr API