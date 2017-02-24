<?php
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\Seller\Model\Repository\Seller as SellerRepository;

abstract class AbstractAction extends Action
{
    /**
     * @var SellerRepository
     */
    protected $sellerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;
    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;


    /**
     * AbstractAction constructor.
     * @param Context $context
     * @param SellerRepository $sellerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param FilterBuilder $filterBuilder
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(
        Context               $context,
        SellerRepository      $sellerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder      $sortOrderBuilder,
        FilterBuilder         $filterBuilder,
        PageFactory           $resultPageFactory,
        Registry              $registry
    ) {
        parent::__construct($context);

        $this->sellerRepository      = $sellerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resultPageFactory     = $resultPageFactory;
        $this->registry = $registry;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->filterBuilder = $filterBuilder;
    }
}
