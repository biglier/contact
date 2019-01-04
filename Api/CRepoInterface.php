<?php
/**
 * interface CRepoInterface for all Contact Repositories
 *
 * @category  Slavik\Contact\Api;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Slavik\Contact\Api\Data\ContactInterface;

interface CRepoInterface
{
    /**
     * Save Contact to db
     *
     * @param ContactInterface $page
     * @return mixed
     */
    public function save(ContactInterface $page);

    /**
     * Return Contact by it id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Delete contact from db
     *
     * @param ContactInterface $page
     * @return mixed
     */
    public function delete(ContactInterface $page);

    /**
     * Delete contact from db by it id
     *
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
