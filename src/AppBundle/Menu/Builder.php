<?php

namespace AppBundle\Menu;

use Knp\Menu\MenuFactory;

class Builder
{
    /**
     * @var MenuFactory
     */
    private $factory;
    /**
     * Builder constructor.
     * @param MenuFactory $factory
     */
    public function __construct(MenuFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param array $options
     * @return \Knp\Menu\ItemInterface|\Knp\Menu\MenuItem
     */
    public function mainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('Home', ['route' => 'homepage']);
        $menu->addChild('Cars', ['route' => 'car_list']);
        $menu->addChild('Manage Cars', ['route' => 'car_index']);

        return $menu;
    }
}