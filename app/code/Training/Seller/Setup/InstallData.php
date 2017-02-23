<?php
namespace Training\Seller\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Seller\Model\SellerFactory;
use Training\Seller\Model\Seller;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Seller factory
     *
     * @var SellerFactory
     */
    private $sellerFactory;

    /**
     * Init
     *
     * @param SellerFactory $sellerFactory
     */
    public function __construct(SellerFactory $sellerFactory)
    {
        $this->sellerFactory = $sellerFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var $seller Seller */
        $seller = $this->sellerFactory->create();
        $seller->setIdentifier('main_seller');
        $seller->setName('Mr Main Seller');
        $seller->save();
    }

}
