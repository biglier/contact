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

    /**
     * Status of contact
     */
    const STATUS_ANSWERED = 1;
    const STATUS_NOTANSWERED = 0;

    /**
     * Return unique ID(s) for each object in system
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int/null
     */
    public function getId()
    {
        return $this->getData(self::CONTACT_ID);
    }

    /**
     * @param $id
     * @return ContactInterface
     */
    public function setId($id)
    {
        return $this->setData(self::CONTACT_ID, $id);
    }

    /**
     * @return string/null
     */
    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * @param $customerName
     * @return ContactInterface
     */
    public function setCustometName($customerName)
    {
        return $this->setData(self::CUSTOMER_NAME, $customerName);
    }

    /**
     * @return string/null
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * @param $customerEmail
     * @return  ContactInterface
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * @return string/null
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param $answer
     * @return ContactInterface
     */
    public function setAnswer($answer)
    {
        $this->setAnsweredStatus('true');
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @param $answeredStatus
     * @return ContactInterface
     */
    public function setAnsweredStatus($answeredStatus)
    {
        return $this->setData(self::ANSWERED_STATUS, $answeredStatus);
    }

    /**
     * @return bool/null
     */
    public function getAnsweredStatus()
    {
        return (bool)$this->getData(self::ANSWERED_STATUS);
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ANSWERED => __('Answered'), self::STATUS_NOTANSWERED => __('Not answered')];
    }

    /**
     * Init Contact
     */
    protected function _construct()
    {
        $this->_init('Slavik\Contact\Model\ResourceModel\Contact');
    }
}