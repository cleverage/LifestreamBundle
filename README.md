LifestreamBundle for Symfony2
=============

Some bla bla.

Installation
-------

Make sure you have a `Palleas` dir, if not create it:

    mkdir src/Palleas

Add the bundle to the `src/` directory. If using
git, you can add it as submodules:

    git submodule add git@github.com:Palleas/LifestreamBundle.git src/Palleas/LifestreamBundle

Next, be sure to enable the bundle in your application kernel:

    // app/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'Palleas'      => __DIR__.'/../src',
        // ...
    ));

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Palleas\LifestreamBundle\PalleasLifestreamBundle(),
            // ...
        );
    }

Load the palleas_lifestream services in the DIC by simply adding the name of the extension :

        # app/config.yml
        palleas_lifestream: ~

Then, import the routing rules if you want to display the provided view :

    # app/config/routing.yml
    lifestream:
        resource: '@PalleasLifestreamBundle/Resources/config/routing.yml'
        prefix: /lifestream

At this point you can access to the lifestream with the url: `http://yoursite.local/lifestream`.