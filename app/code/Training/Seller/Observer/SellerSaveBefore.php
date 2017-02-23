<?php

namespace Training\Seller\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Training\Seller\Api\Data\SellerInterface;

class SellerSaveBefore implements ObserverInterface
{

    /**
     * Core date model
     *
     * @var DateTime
     */
    protected $date;

    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }


    // Note: this is generic and can be reused
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var SellerInterface $object */
        $object = $observer->getEntity();

        $date = $this->date->gmtDate();

        if (!$object->getSellerId()) {
            $object->setCreatedAt($date);
        }
        $object->setUpdatedAt($date);
    }
}
