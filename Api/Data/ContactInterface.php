<?php
/**
 * interface ContactInterface
 *
 * @category  Slavik\Contact\Api\Data;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Api\Data;

interface ContactInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const CONTACT_ID = 'contact_id';
    const CUSTOMER_NAME = 'customer_name';
    const CUSTOMER_EMAIL = 'customer_email';
    const TEXT = 'text';
    const ANSWER = 'answer';
    const ANSWERED_STATUS = 'answered_status';
    /**#@-*/

    /**
     * @return int/null
     */
    public function getId();

    /**
     * @param $id
     * @return ContactInterface
     */
    public function setId($id);

    /**
     * @return string/null
     */
    public function getCustomerName();

    /**
     * @param $customerName
     * @return ContactInterface
     */
    public function setCustometName($customerName);

    /**
     * @return string/null
     */
    public function getCustomerEmail();

    /**
     * @param $customerEmail
     * @return  ContactInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * @return string/null
     */
    public function getAnswer();

    /**
     * @param $answer
     * @return ContactInterface
     */
    public function setAnswer($answer);

    /**
     * @return bool/null
     */
    public function getAnsweredStatus();

    /**
     * @param $answeredStatus
     * @return ContactInterface
     */
    public function setAnsweredStatus($answeredStatus);
}
