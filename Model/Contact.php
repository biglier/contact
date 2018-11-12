<?php
/**
 * class Contact
 *
 * @category  Slavik\Contact\Model;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Model;

use Slavik\Contact\Api\Data\ContactInterface;

class Contact extends \Magento\Framework\Model\AbstractModel implements ContactInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'slavik_contact_contact';

    /***
     *
     */
    protected function _construct()
    {
        $this->_init('Slavik\Contact\Model\ResourceModel\Contact');
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}