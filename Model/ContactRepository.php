<?php
/**
 * class ContactRepository
 *
 * @category  Slavik\Contact\Model;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Model;

use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Slavik\Contact\Api;
use Slavik\Contact\Api\Data\ContactInterface;
use Slavik\Contact\Model\ResourceModel\Contact as ObjectResourceModel;
use Slavik\Contact\Model\ResourceModel\Contact\CollectionFactory;

class ContactRepository implements Api\CRepoInterface
{

    /**
     * Contact Factory
     *
     * @var Slavik\Contact\Model\ContactFactory
     */
    protected $objectFactory;

    /**
     * Object Resource Model
     *
     * @var Slavik\Contact\Model\ResourceModel\Contact
     */
    protected $objectResourceModel;

    /**
     * Collection Factory
     *
     * @var CSlavik\Contact\Model\ResourceModel\Contact\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Search Result Interface Factory
     *
     * @var Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * ContactRepository constructor.
     * @param ContactFactory $objectFactory
     * @param ObjectResourceModel $objectResourceModel
     * @param CollectionFactory $collectionFactory
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ContactFactory $objectFactory,
        ObjectResourceModel $objectResourceModel,
        CollectionFactory $collectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->objectFactory = $objectFactory;
        $this->objectResourceModel = $objectResourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @param ContactInterface $object
     * @return mixed|ContactInterface
     * @throws CouldNotSaveException
     */
    public function save(ContactInterface $object)
    {
        try {
            $this->objectResourceModel->save($object);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
        return $object;
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }

    /**
     * @param ContactInterface $object
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
    public function delete(ContactInterface $object)
    {
        try {
            $this->objectResourceModel->delete($object);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param $id
     * @return mixed|Contact
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $object = $this->objectFactory->create();
        $this->objectResourceModel->load($object, $id);
        if (!$object->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $id));
        }
        return $object;
    }
}