<?php
namespace Training\Seller\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Seller\Api\Data\SellerInterface;

/**
 * Seller Model
 *
 */
class Seller extends AbstractModel implements SellerInterface, IdentityInterface
{

    const CACHE_TAG = 'training_seller';

    /**
     * @var string
     */
    protected $_cacheTag = 'training_seller';


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\Seller\Model\ResourceModel\Seller');
    }

    /**
     * Return identities
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getIdentifier()];
    }

    /**
     * @inheritdoc
     */
    public function getSellerId()
    {
        return $this->getId();
    }

    /**
     * @inheritdoc
     */
    public function getIdentifier()
    {
        return (string) $this->getData(self::FIELD_IDENTIFIER);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return (string) $this->getData(self::FIELD_NAME);
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt()
    {
        return (string) $this->getData(self::FIELD_UPDATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt()
    {
        return (string) $this->getData(self::FIELD_CREATED_AT);
    }

    /**
     * @inheritdoc
     */
    public function setSellerId($value)
    {
        return $this->setId((int) $value);
    }

    /**
     * @inheritdoc
     */
    public function setIdentifier($value)
    {
        return $this->setData(self::FIELD_IDENTIFIER, (string) $value);
    }

    /**
     * @inheritdoc
     */
    public function setName($value)
    {
        return $this->setData(self::FIELD_NAME, (string) $value);
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedAt($value)
    {
        return $this->setData(self::FIELD_UPDATED_AT, (string) $value);
    }

    /**
     * @inheritdoc
     */
    public function setCreatedAt($value)
    {
        return $this->setData(self::FIELD_CREATED_AT, (string) $value);
    }

}
