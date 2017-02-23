<?php
namespace Training\Seller\Api\Data;

/**
 * Seller data interface.
 * @api
 */
interface SellerInterface
{
    /**#@+
     * Constants
     */
    const TABLE_NAME                       = 'training_seller';

    const FIELD_SELLER_ID                  = 'seller_id';
    const FIELD_IDENTIFIER                 = 'identifier';
    const FIELD_NAME                       = 'name';
    const FIELD_CREATED_AT                 = 'created_at';
    const FIELD_UPDATED_AT                 = 'updated_at';
    /**#@-*/

    /**
     * Get seller ID
     *
     * @return int|null
     */
    public function getSellerId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();


    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set seller ID
     *
     * @param int $id
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function setSellerId($id);

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function setIdentifier($identifier);

    /**
     * Set name
     *
     * @param string $name
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function setName($name);

    /**
     * Set creation date
     *
     * @param string $date
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function setCreatedAt($date);

    /**
     * Set update date
     *
     * @param string $date
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function setUpdatedAt($date);

}
