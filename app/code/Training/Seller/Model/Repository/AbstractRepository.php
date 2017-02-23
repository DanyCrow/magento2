<?php
namespace Training\Seller\Model\Repository;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\Collection;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Data\Collection\AbstractDb as AbstractCollection;
use Magento\Framework\Data\Collection\EntityFactoryInterface;

/**
 * AbstractRepository
 *
 */
abstract class AbstractRepository
{

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected $objectResource;

    /**
     * Object Factory
     * @var \Magento\Framework\Model\AbstractModelFactory
     */
    protected $objectFactory;

    /**
     * Search Result Factory
     * @var \Magento\Framework\Api\SearchResultsFactory
     */
    protected $searchResultsFactory;

    /**
     * Repository cache by id
     *
     * @var array
     */
    protected $objectRepoById = [];

    /**
     * Repository cache by identifier

     * @var array
     */
    protected $objectRepoByCode = [];

    /**
     * The identifier field name for the getByIdentifier method
     *
     * @var string|null
     */
    protected $identifierFieldName = null;


    /**
     * AbstractRepository constructor.
     *
     * @param \Magento\Framework\Model\AbstractModelFactory        $objectFactory
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $objectResource
     * @param \Magento\Framework\Api\SearchResultsFactory          $searchResultsFactory
     */
    public function __construct(
        $objectFactory,
        $objectResource,
        $searchResultsFactory
    ) {
        $this->objectFactory        = $objectFactory;
        $this->objectResource       = $objectResource;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Set identifier field name
     *
     * @param string|null $fieldName
     */
    protected function setIdentifierFieldName($fieldName = null)
    {
        $this->identifierFieldName = $fieldName;
    }

    /**
     * Get entity by id
     *
     * @param $entityId
     * @return \Magento\Framework\Model\AbstractModel
     * @throws NoSuchEntityException
     */
    protected function getEntityById($entityId)
    {
        if (!isset($this->objectRepoById[$entityId])) {

            $object = $this->objectFactory->create();
            $this->objectResource->load($object, $entityId);

            if (!$object->getId()) {
                // Object does not exists
                throw new NoSuchEntityException(__('Requested entity is not found'));
            }
            $this->objectRepoById[$entityId] = $object;

            // Remember that some object do not have identifier (eg.: categories)
            if (!is_null($this->identifierFieldName)) {
                $this->objectRepoByCode[$object->getData($this->identifierFieldName)] = $object;
            }
        }

        return $this->objectRepoById[$entityId];
    }

    /**
     * Get entity by identifier
     *
     * @param $identifier
     * @return AbstractModel
     * @throws NoSuchEntityException
     */
    protected function getEntityByIdentifier($identifier)
    {
        if (!isset($this->objectRepoByCode[$identifier])) {

            if (is_null($this->identifierFieldName)) {
                throw new NoSuchEntityException(__('Identifier field name is not set'));
            }

            $object = $this->objectFactory->create();
            $this->objectResource->load($object, $identifier, $this->identifierFieldName);

            if (!$object->getId()) {
                // Object does not exists
                throw new NoSuchEntityException(__('Requested entity is not found'));
            }
            $this->objectRepoByCode[$this->identifierFieldName] = $object;
            $this->objectRepoById[$object->getId()] = $object;
        }

        return $this->objectRepoByCode[$identifier];
    }


    /**
     * Save entity
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return \Magento\Framework\Model\AbstractModel
     * @throws CouldNotSaveException
     */
    protected function saveEntity(AbstractModel $object)
    {
        try {
            $this->objectResource->save($object);
            unset($this->objectRepoById[$object->getId()]);

            if (!is_null($this->identifierFieldName)) {
                $objectIdentifier = $object->getData($this->identifierFieldName);
                unset($this->objectRepoByCode[$objectIdentifier]);
            }
        } catch (\Exception $e) {
            // Note: here we lose previous exception stack trace
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $object;
    }


    /**
     * Delete entity
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return boolean
     * @throws CouldNotDeleteException
     */
    protected function deleteEntity(AbstractModel $object)
    {
        try {
            $this->objectResource->delete($object);
            unset($this->objectRepoById[$object->getId()]);

            if (!is_null($this->identifierFieldName)) {
                $objectIdentifier = $object->getData($this->identifierFieldName);
                unset($this->objectRepoByCode[$objectIdentifier]);
            }
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }




    /**
     * Retrieve not eav entities which match a specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria search criteria
     *
     * @return \Magento\Framework\Api\SearchResults
     */
    protected function getEntities(SearchCriteriaInterface $searchCriteria = null)
    {
        $collection = $this->getEntityCollection();

        /** @var \Magento\Framework\Api\SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();

        if ($searchCriteria) {
            $searchResults->setSearchCriteria($searchCriteria);
            $this->prepareCollectionFromSearchCriteria($collection, $searchCriteria);
        }

        // load the collection
        $collection->load();

        // build the result
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }


    /**
     * get the entity collection
     *
     * @return AbstractCollection
     */
    protected function getEntityCollection()
    {
        return $this->objectFactory->create()->getCollection();
    }


    /**
     * Prepare a collection from a search criteria
     *
     * @param AbstractCollection      $collection     The collection of object to prepare
     * @param SearchCriteriaInterface $searchCriteria The search criteria to use
     *
     * @return void
     */
    protected function prepareCollectionFromSearchCriteria(
        AbstractCollection $collection,
        SearchCriteriaInterface $searchCriteria
    ) {
        $this->prepareCollectionFromSearchCriteriaFilter($collection, $searchCriteria);
        $this->prepareCollectionFromSearchCriteriaOrder($collection, $searchCriteria);
        $this->prepareCollectionFromSearchCriteriaPage($collection, $searchCriteria);
    }

    /**
     * Prepare a collection from a search criteria - Filter Part
     *
     * @param AbstractCollection      $collection     The collection of object to prepare
     * @param SearchCriteriaInterface $searchCriteria The search criteria to use
     *
     * @return void
     */
    protected function prepareCollectionFromSearchCriteriaFilter(
        AbstractCollection $collection,
        SearchCriteriaInterface $searchCriteria
    ) {
        // apply filters
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $fields[] = $filter->getField();
                $conditions[] = [$condition => $filter->getValue()];
            }
            if ($fields) {
                $collection->addFieldToFilter($fields, $conditions);
            }
        }
    }

    /**
     * Prepare a collection from a search criteria - Order Part
     *
     * @param AbstractCollection      $collection     The collection of object to prepare
     * @param SearchCriteriaInterface $searchCriteria The search criteria to use
     *
     * @return void
     */
    protected function prepareCollectionFromSearchCriteriaOrder(
        AbstractCollection $collection,
        SearchCriteriaInterface $searchCriteria
    ) {
        // apply orders
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($sortOrders as $sortOrder) {
                // Note: is ascending here does mapping between db sort naming and collection sort naming
                $isAscending = ($sortOrder->getDirection() == SortOrder::SORT_ASC);
                $collection->addOrder(
                    $sortOrder->getField(),
                    $isAscending ? Collection::SORT_ORDER_ASC : Collection::SORT_ORDER_DESC
                );
            }
        }
    }

    /**
     * Prepare a collection from a search criteria - Page Part
     *
     * @param AbstractCollection      $collection     The collection of object to prepare
     * @param SearchCriteriaInterface $searchCriteria The search criteria to use
     *
     * @return void
     */
    protected function prepareCollectionFromSearchCriteriaPage(
        AbstractCollection $collection,
        SearchCriteriaInterface $searchCriteria
    ) {
        // apply paging
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
    }

}
