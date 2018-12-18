<?php
/**
 * interface CRepoInterface
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
     * @param ContactInterface $page
     * @return mixed
     */
    public function save(ContactInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param ContactInterface $page
     * @return mixed
     */
    public function delete(ContactInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
