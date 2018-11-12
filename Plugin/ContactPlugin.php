<?php

/**
 * ContactPlugin
 *
 * @category  Slavik\Contact\Plugin;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */


namespace Slavik\Contact\Plugin;

use Slavik\Contact\Model\ContactFactory;
use Magento\Contact\Controller\Index;
use Slavik\Contact\Model\ContactRepository;


class ContactPlugin
{

    protected $contactFactory;
    protected $contactRepository;

    /**
     * @param ContactFactory $contactFactory
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactFactory $contactFactory, ContactRepository $contactRepository)
    {
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param $subject
     * @param $result
     */
    public function afterExecute($subject, $result)
    {

        $request = $subject->getRequest();
        $contact = $this->contactFactory->create();
        return $result;
    }
}