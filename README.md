Simple text page bundle
===========================================

Module for create simple text pages with SonataAdmin backend.

Installation
------------
1. command to add the bundle to your composer.json and download package.

``` bash
$ composer require "sip/text-bundle": "dev-master"
```

2. Enable the bundle inside the kernel.

``` php
<?php

// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        new SIP\TextBundle\SIPTextBundle(),
        new Genemu\Bundle\FormBundle\GenemuFormBundle(),
        // If you wish to use SonataAdmin
        new Sonata\BlockBundle\SonataBlockBundle(),
        new Sonata\jQueryBundle\SonatajQueryBundle(),
        new Sonata\AdminBundle\SonataAdminBundle(),

        // Other bundles...
    );
}
```

[Read more about installation SonataAdminBundle](http://sonata-project.org/bundles/admin/master/doc/reference/installation.html#installation)

3. Creating your entity

``` php
<?php
namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SIP\TextBundle\Entity\Text as BaseText;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_text")
 */
class Text extends BaseText
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
```

4. Updating database schema

``` bash
$ php app/console doctrine:schema:update --force
```

This should be done only in dev environment! We recommend using Doctrine migrations, to safely update your schema.