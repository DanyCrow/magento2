<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;


/**
 * Action: Index/Index
 */
class Search extends Action
{

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepositoryInterface;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;
    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;


    /**
     * @param Context $context
     * @param ProductRepositoryInterface $productRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @internal param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    public function __construct(
        Context $context,
        ProductRepositoryInterface $productRepositoryInterface,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        parent::__construct($context);

        $this->productRepositoryInterface = $productRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }


    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->appendBody(__METHOD__);
        $this->getResponse()->appendBody('<hr/>');
        $this->getResponse()->appendBody($this->getHtml());
        $this->getResponse()->appendBody('<hr/>');
    }


    public function getHtml()
    {

        $filter1 = $this->filterBuilder
            ->setField('description')
            ->setConditionType('like')
            ->setValue('%comfortable%')
            ->create();
        $filter2 = $this->filterBuilder
            ->setField('name')
            ->setConditionType('like')
            ->setValue('%bruno%')
            ->create();
        $sortOrder = $this->sortOrderBuilder
            ->setField('name')
            ->setDirection('DESC')
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$filter1])
            ->addFilters([$filter2])
            ->addSortOrder($sortOrder)
            ->setPageSize(6)
            ->setCurrentPage(1)
            ->create();

        $products = $this->productRepositoryInterface->getList($searchCriteria)->getItems();

        $html = '';
        $html .= '<br/>';
        foreach ($products as $product) {
            $html .= $product->getName();
            $html .= '<br/>';
        }
        return $html;
    }

}
