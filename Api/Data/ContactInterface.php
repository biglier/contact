<?php
/**
 * interface ContactInterface for all Contact instances
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
     * Return contact id
     *
     * @return int/null
     */
    public function getId();

    /**
     * Set contact id
     *
     * @param $id
     * @return ContactInterface
     */
    public function setId($id);

    /**
     * Return contact customer name
     *
     * @return string/null
     */
    public function getCustomerName();

    /**
     * Set contact customer name
     *
     * @param $customerName
     * @return ContactInterface
     */
    public function setCustometName($customerName);

    /**
     * Return contact customer email
     *
     * @return string/null
     */
    public function getCustomerEmail();

    /**
     * Set contact customer email
     *
     * @param $customerEmail
     * @return  ContactInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Return contact answer
     *
     * @return string/null
     */
    public function getAnswer();

    /**
     * Set contact answer
     *
     * @param $answer
     * @return ContactInterface
     */
    public function setAnswer($answer);

    /**
     * Return contact answered status
     *
     * @return bool/null
     */
    public function getAnsweredStatus();

    /**
     * Set contact answered status
     *
     * @param $answeredStatus
     * @return ContactInterface
     */
    public function setAnsweredStatus($answeredStatus);
}
