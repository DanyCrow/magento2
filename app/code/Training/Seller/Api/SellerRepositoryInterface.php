<?php
namespace Training\Seller\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\Data\SellerInterface;
use Training\Seller\Api\Data\SellerSearchResultsInterface;

/**
 * Seller CRUD interface.
 * @api
 */
interface SellerRepositoryInterface
{

    /**
     * Retrieve seller
     *
     * @param int $sellerId
     * @return SellerInterface
     */
    public function getById($sellerId);

    /**
     * Retrieve seller
     *
     * @param $identifier
     * @return SellerInterface
     */
    public function getByIdentifier($identifier);

    /**
     * Retrieve seller list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SellerSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save seller
     *
     * @param SellerInterface $seller
     * @return SellerInterface
     *
     * @throws CouldNotSaveException
     */
    public function save(SellerInterface $seller);

    /**
     * Delete seller
     *
     * @param int $sellerId
     * @return bool
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteById($sellerId);

    /**
     * Delete seller
     *
     * @param string $identifier
     * @return bool
     *
     * @throws NoSuchEntityException
     * @throws CouldNotDeleteException
     */
    public function deleteByIdentifier($identifier);

}
