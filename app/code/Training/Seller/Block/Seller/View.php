<?php

namespace Training\Seller\Block\Seller;

use Magento\Framework\DataObject\IdentityInterface;


class View extends AbstractBlock implements IdentityInterface
{
    /**
     * Used to set the cache infos
     *
     * @return void
     */
    protected function _construct()
    {
        $seller = $this->getCurrentSeller();
        if ($seller) {
            // Note: we won't use a cache flush by ID, but only by tags: here we set only a unique key for redis
            $this->setData('cache_key', 'seller_view_' . $seller->getId());
        }
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    // Note: we won't use a cache flush by ID, but only by tags: here are tags
    public function getIdentities()
    {
        $identities = [];

        $seller = $this->getCurrentSeller();
        if ($seller) {
            $identities = $seller->getIdentities();
        }

        return $identities;
    }

    /**
     * Get the current seller
     *
     * @return \Training\Seller\Model\Seller
     */
    public function getCurrentSeller()
    {
        return $this->registry->registry('current_seller');
    }

}
