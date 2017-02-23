<?php
namespace Training\Seller\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Seller search result interface.
 * @api
 */
interface SellerSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get seller list
     *
     * @return SellerInterface[]
     */
    public function getItems();

    /**
     * Set seller list
     *
     * @param SellerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}