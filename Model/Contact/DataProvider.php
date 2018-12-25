<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 20.12.18
 * Time: 16:26
 */
namespace Slavik\Contact\Model\Contact;

use Slavik\Contact\Model\Contact;
use Slavik\Contact\Model\ResourceModel\Contact\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Slavik\Contact\Model\ResourceModel\Contact\CollectionFactory $contactCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @Contact $contact */
        foreach ($items as $contact) {
            // notre fieldset s'apelle "contact" d'ou ce tableau pour que magento puisse retrouver ses datas :
            $this->loadedData[$contact->getId()] = $contact->getData();
        }

        //var_dump($this->loadedData);
        //die();
        return $this->loadedData;

    }
}