<?php

namespace Training\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller collection
 */
class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\Seller\Model\Seller', 'Training\Seller\Model\ResourceModel\Seller');
    }

    /**
     * Returns pairs ID - name for unique ID
     *
     * @return array
     */
    public function toOptionIdArray()
    {
        return $this->_toOptionArray(SellerInterface::FIELD_SELLER_ID, SellerInterface::FIELD_NAME);
    }

}
