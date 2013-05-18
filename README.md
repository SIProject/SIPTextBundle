Simple text page bundle
=======================

Module for create simple text pages with SonataAdmin backend.

Installation
============

1. command to add the bundle to your composer.json and download package.
------------------------------------------------------------------------

``` bash
$ composer require "sip/text-bundle": "dev-master"
```

2. Enable the bundle inside the kernel.
---------------------------------------

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
-----------------------

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
---------------------------

``` bash
$ php app/console doctrine:schema:update --force
```

This should be done only in dev environment! We recommend using Doctrine migrations, to safely update your schema.

5. Importing routing configuration
----------------------------------

``` yml
SIPTextBundle:
    resource: '@SIPTextBundle/Resources/config/routing.yml'
    prefix:   /
```

6. Configuration:
-----------------

``` yml
# app/config/config.yml
sip_text:
    model: MyBundle\Entity\Text
    # All Default configuration:
    # controller: Sylius\Bundle\ResourceBundle\Controller\ResourceController
    # repository: Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository
    # admin: SIP\TextBundle\Admin\TextAdmin
```

7. Templates
------------

The bundle requires only the show.html template.
Easiest way to override the view is placing it here app/Resources/SIPTextBundle/views/Text/show.html.twig.

8. Usage
--------

Create a menu for text pages

``` php
<?php

namespace MyBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav'
            )
        ));

        $childOptions = array(
            'attributes'         => array('class' => 'dropdown'),
            'childrenAttributes' => array('class' => 'dropdown-menu'),
            'labelAttributes'    => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#')
        );

        $child = $menu->addChild('Text pages', $childOptions);

        $textPages = $this->getTextRepository()->findBy(array('disabled' => 0));
        foreach ($textPages as $textPage) {
            $child->addChild($textPage->getTitle(), array(
                'route'           => 'sip_text_text_item',
                'routeParameters' => array(
                    'slug'  => $textPage->getSlug()
                ),
                'labelAttributes' => array('icon' => 'icon-chevron-right')
            ));
        }

        return $menu;
    }

    public function getTextRepository()
    {
        return $this->container->get('sip_text.repository.text');
    }
}
```

Now you have a menu of text pages and you can use it in your template.
[Read more about rendering knp menu](https://github.com/KnpLabs/KnpMenuBundle/blob/master/Resources/doc/index.md#rendering-menus)
