<?php

namespace Training\Seller\Block\Seller;

use Magento\Framework\Api\SortOrder;


// Note: we do not need to implement IdentityInterface because page isn't cached
class Index extends AbstractBlock
{

    /**
     * Get the current seller
     *
     * @return \Training\Seller\Api\Data\SellerSearchResultsInterface
     */
    public function getSearchResult()
    {
        return $this->registry->registry('seller_search_result');
    }

    /**
     * Get the number of results
     *
     * @return int
     */
    public function getCount()
    {
        $searchResult = $this->getSearchResult();

        return $searchResult->getTotalCount();
    }

    /**
     * Get the name filter
     *
     * @return string
     */
    public function getSearchName()
    {
        $filterGroups = $this->getSearchResult()->getSearchCriteria()->getFilterGroups();

        $name = '';

        if (count($filterGroups) == 1) {
            $filters = $filterGroups[0]->getFilters();

            if (count($filters) == 1) {
                $name = str_replace('%', '', $filters[0]->getValue());
            }
        }

        return $name;
    }

    /**
     * Get the filter sort order
     *
     * @return string
     */
    public function getSortOrder()
    {
        $sortOrders = $this->getSearchResult()->getSearchCriteria()->getSortOrders();

        $order = SortOrder::SORT_ASC;
        if (count($sortOrders) == 1) {
            $order = $sortOrders[0]->getDirection();
        }

        return $order;
    }

}
