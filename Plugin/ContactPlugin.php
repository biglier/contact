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

use Slavik\Contact\Model\Contact;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;

class ContactPlugin
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * @param ContactFactory $contactFactory
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        ContactFactory $contactFactory,
        ContactRepository $contactRepository
    )
    {
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param $subject
     * @param $result
     * @return mixed
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function afterExecute($subject, $result)
    {
        $request = $subject->getRequest();
        /** @var Contact $contact */
        $contact = $this->contactFactory->create();
        $contact->setData('customer_name', $request->getParam('name'));
        $contact->setData('customer_email', $request->getParam('email'));
        $contact->setData('text', $request->getParam('comment'));
        $contact->setData('answered_status', 0);
        $this->contactRepository->save($contact);
        return $result;
    }
}
