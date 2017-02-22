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
class Index extends Action
{

    protected $productFactory;

    /**
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        parent::__construct($context);

        // Note: new parameters are after parent constructor, so it won't broke signature
        $this->productFactory = $productFactory;
    }


    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $product = $this->getProduct();
        if (is_null($product)) {
            $this->_forward('noroute');
            return;
        }

        $this->getResponse()->appendBody("Product ID: #" . $product->getId());
        $this->getResponse()->appendBody("<br/>");
        $this->getResponse()->appendBody("Product name: " . $product->getName());
    }


    /**
     * get product from request product id param
     *
     * @return \Magento\Catalog\Model\Product|null
     */
    protected function getProduct()
    {
        $request = $this->getRequest();
        $productId = (int) $request->getParam('id');
        if (!$productId) {
            return null;
        }

        $product = $this->productFactory->create();
        $product->getResource()->load($product, $productId);
        if (!$product->getId()) {
            return null;
        }

        return $product;
    }

}
