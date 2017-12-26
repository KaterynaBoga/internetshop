<?php

namespace App\Entity;

use App\Controller\ProductController;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @return mixed
     */

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, unique=true)
     */
    private $slug;

    /**
     * @var Product[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
     */
    private $products;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subcategories" )
     * @ORM\JoinColumn(name="parent_id", onDelete="CASCADE")
     *
     */
    private $parent;

    /**
     * @var Category[]ArrayCollection;
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent")
     */
    private $subcategories;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName(): ? string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): ? string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Category
     */
    public function setSlug(string $slug): Category
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return Product[]|ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[]|ArrayCollection $products
     * @return Category
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    public function addProduct(Product $product)
    {
        $this->products->add($product);
        $product->setCategory($this);

        return $this;
    }

    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function __toString()
    {
        return $this->getName() ?: '';
    }

    /**
     * @return Category
     */
    public function getParent(): ? Category
    {
        return $this->parent;
    }

    /**
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent): Category
    {
        $this->parent = $parent;
        return $this;
    }

}
