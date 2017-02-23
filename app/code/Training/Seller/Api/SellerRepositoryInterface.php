<?php
namespace Training\Seller\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Seller CRUD interface.
 * @api
 */
interface SellerRepositoryInterface
{

    /**
     * Retrieve seller
     *
     * @param int $objectId
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function getById($objectId);

    /**
     * Retrieve seller
     *
     * @param string $objectIdentifier
     * @return \Training\Seller\Api\Data\SellerInterface
     */
    public function getByIdentifier($objectIdentifier);

    /**
     * Retrieve seller list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Seller\Api\Data\SellerSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Save seller
     *
     * @param \Training\Seller\Api\Data\SellerInterface $object
     * @return \Training\Seller\Api\Data\SellerInterface
     *
     * @throws CouldNotSaveException
     */
    public function save(\Training\Seller\Api\Data\SellerInterface $object);

    /**
     * Delete seller
     *
     * @param int $objectId
     * @return bool
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById($objectId);

    /**
     * Delete seller
     *
     * @param string $objectIdentifier
     * @return bool
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteByIdentifier($objectIdentifier);

}
