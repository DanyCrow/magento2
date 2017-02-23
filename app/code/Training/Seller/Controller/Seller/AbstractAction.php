<?php
namespace Training\Seller\Controller\Seller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
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
     * AbstractAction constructor.
     * @param Context $context
     * @param SellerRepository $sellerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        Context               $context,
        SellerRepository      $sellerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->sellerRepository      = $sellerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($context);
    }
}
