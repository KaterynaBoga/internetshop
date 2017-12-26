<?php
/**
 * Created by PhpStorm.
 * User: BKN1402
 * Date: 19.12.2017
 * Time: 19:27
 */

namespace App\Menu;


use App\Service\Catalogue;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @var Catalogue
     */
    private $catalogueService;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Catalogue $catalogue)
    {
        $this->factory = $factory;
        $this->catalogueService = $catalogue;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Главная', array('route' => 'homepage'));
        $catalogueMenu = $menu->addChild('Каталог', ['route' => 'categories_list']);
        $catalogueMenu->setExtra('dropdown', true);

        // ... add more children

        foreach ($this->catalogueService->getTopCategories() as $category) {
            $catalogueMenu->addChild($category->getName(), [
                'route' => 'category_show',
                'routeParameters' => ['slug' => $category->getSlug()]]);

        }

        return $menu;
    }
}