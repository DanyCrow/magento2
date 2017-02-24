<?php

namespace Training\Seller\Controller\Seller;
use Magento\Framework\Api\SortOrder;
use Training\Seller\Api\Data\SellerInterface;


/**
 * Action: Index/Index
 */
class Index extends AbstractAction
{


    /**
     * Execute the action
     *
     * @return \Magento\Framework\View\Result\Page|null
     */
    public function execute()
    {
        $searchCriteria = $this->getSearchCriteria();

        // Get seller list
        $result = $this->sellerRepository->getList($searchCriteria);

        $this->registry->register('seller_search_result', $result);

        // Display the page using layout
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Sellers list'));

        return $resultPage;

    }

    /**
     * @return \Magento\Framework\Api\SearchCriteria
     */
    public function getSearchCriteria()
    {
        // get the asked filter name, with protection
        $searchName = (string) $this->_request->getParam('search_name', '');
        $searchName = strip_tags($searchName);
        $searchName = preg_replace('/[\'"%]/', '', $searchName);
        $searchName = trim($searchName);

        // build the filter, if needed, and add it to the criteria
        if ($searchName!== '') {
            // build the filter for the name
            $filters[] = $this->filterBuilder
                ->setField(SellerInterface::FIELD_NAME)
                ->setConditionType('like')
                ->setValue("%$searchName%")
                ->create();

            // add the filter to the criteria
            $this->searchCriteriaBuilder->addFilters($filters);
        }

        // get the asked sort order, with protection
        $sortOrder = (string) $this->_request->getParam('sort_order');
        $availableSort = [
            SortOrder::SORT_ASC,
            SortOrder::SORT_DESC,
        ];
        if (!in_array($sortOrder, $availableSort)) {
            $sortOrder = $availableSort[0];
        }

        // build the sort order and add it to the criteria
        $sort = $this->sortOrderBuilder
            ->setField(SellerInterface::FIELD_NAME)
            ->setDirection($sortOrder)
            ->create();
        $this->searchCriteriaBuilder->addSortOrder($sort);

        // build the criteria
        return $this->searchCriteriaBuilder->create();
    }

}
