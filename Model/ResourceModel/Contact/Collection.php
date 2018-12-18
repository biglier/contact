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

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
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
