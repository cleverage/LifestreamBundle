LifestreamBundle for Symfony2
=============

Requirement
-------

This Bundle use Buzz to talk with the outside world. You need to install it too.

Installation
-------

Add the bundle to the `vendor/bundles` directory. If using
git, you can add it as submodules:

    git submodule add git@github.com:Cleverage/LifestreamBundle.git vendor/bundles/CleverAge/Bundle/LifestreamBundle

And if not already done, get Buzz:

    git submodule add git@github.com:kriswallsmith/Buzz.git vendor/buzz

Next, be sure to enable the bundle and Buzz in your application:

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'CleverAge'        => __DIR__.'/../vendor/bundles',
        'Buzz'             => __DIR__.'/../vendor/buzz/lib',
        // ...
    ));

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new CleverAge\Bundle\LifestreamBundle\CleverAgeLifestreamBundle(),
            // ...
        );
    }

Load the clever_age_lifestream services by simply adding the name of the extension :

    clever_age_lifestream:
        apis:
            lastfm:
                class: CleverAge\Bundle\LifestreamBundle\ApiClient\Lastfm
                config:
                    username: USERNAME
                    api_key:  b25b959554ed76058ac220b7b2e0a026

Then, import the routing rules if you want to display the provided view :

    lifestream:
        resource: '@CleverAgeLifestreamBundle/Resources/config/routing.yml'
        prefix: /lifestream

At this point you can access to the lifestream with the url: `http://yoursite.local/lifestream`.

Words about the configuration
-------

In your config.yml:

    clever_age_lifestream:
        apis:
            lastfm:
                class: CleverAge\Bundle\LifestreamBundle\ApiClient\Lastfm
                config:
                    username: USERNAME
                    api_key:  YOURKEY
            twitter:
                class: CleverAge\Bundle\LifestreamBundle\ApiClient\Twitter
                config:
                  username: USERNAME

You can add as many "apis" node as you like. The "config" node contain parameters send to the constructor of the Api class.
All your Api class must extend CleverAge\Bundle\LifestreamBundle\ApiClient\BaseApi.
Each api will be available as a Symfony service, following a ''lifestream.APINAME'' pattern.
The ''lifestream'' service is also available and allow you to perform actions on all the API's.

Todo
-------

- Work on the Flickr API
- Find a way to deal with Proxy (perhaps submit improvement to the Buzz lib)
- Provide methods for statistic display
- Provide default view for all the default services
- MOAR DEFAULT SERVICE!!11
- Find a way to get the EntityManager inside an Entity (for the isNew() method call)