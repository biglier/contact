<?php
/**
 * class Collection
 *
 * @category  Slavik\Contact\Model\ResourceModel\Contact;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */
namespace Slavik\Contact\Model\ResourceModel\Contact;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('Slavik\Contact\Model\Contact',
            'Slavik\Contact\Model\ResourceModel\Contact');
    }
}
