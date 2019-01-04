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
     * Contact Factory
     *
     * @var Slavik\Contact\Model\ContactFactory;
     */
    protected $contactFactory;

    /**
     * Contact Repository
     *
     * @var Slavik\Contact\Model\ContactRepository;
     */
    protected $contactRepository;

    /**
     * ContactPlugin constructor.
     *
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
     * Save contact to base after validation
     *
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
