<?php
/**
 * class Contact
 *
 * @category  Slavik\Contact\Model\ResourceModel;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends  AbstractDb
{
    /**
     *
     */
    protected  function  _construct()
    {
        $this->_init('contact','contact_id');
    }
}