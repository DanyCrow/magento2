<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;

use Magento\Framework\App\Action\Action;


/**
 * Action: Index/Index
 */
class Categories extends Action
{

    protected $productCollectionFactory;
    protected $categoryCollectionFactory;


    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    ) {
        parent::__construct($context);

        $this->productCollectionFactory = $productCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;

    }


    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->appendBody($this->getDataToDisplay());
    }


    public function getDataToDisplay()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = $this->productCollectionFactory->create();
        $productCollection
            ->addAttributeToFilter('name', array('like' => '%bag%'))
            ->addCategoryIds()
            ->load();

        $categoryIds = [];

        foreach ($productCollection as $product) {
            /** @var \Magento\Catalog\Model\Product $product */
            $categoryIds = array_merge($categoryIds, $product->getCategoryIds());
        }
        $categoryIds = array_unique($categoryIds);

        /** @var \Magento\Catalog\Model\ResourceModel\Category\Collection $productCollection */
        $categoryCollection = $this->categoryCollectionFactory->create();
        $categoryCollection
            ->addAttributeToFilter('entity_id', array('in' => $categoryIds))
            ->addAttributeToSelect('name')
            ->load();

        $categories = [];
        foreach ($categoryCollection as $cat) {
            /** @var \Magento\Catalog\Model\Category $cat */
            $categories[$cat->getId()] = $cat->getName();
        }

        $html = '<ul>';
        foreach ($productCollection as $product) {
            $html.= '<li>';
        $html.= $product->getId().' => '.$product->getSku().' => '.$product->getName();
        $html.= '<ul>';
        foreach ($product->getCategoryIds() as $categoryId) {
            $html.= '<li>'.$categoryId.' => '.$categories[$categoryId].'</li>';
        }
        $html.= '</ul>';
        $html.= '</li>';
        }
        $html.= '</ul>';

        return $html;
    }

}
