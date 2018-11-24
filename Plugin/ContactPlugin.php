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

use Magento\Setup\Exception;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\Context;
use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;

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
    public function __construct(ContactFactory $contactFactory,
                                ContactRepository $contactRepository
    )
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
        $contact->setData('customer_name', $request->getParam('name'));
        $contact->setData('customer_email', $request->getParam('email'));
        $contact->setData('text', $request->getParam('comment'));
        $contact->setData('answered_status','false');
        $this->contactRepository->save($contact);
        return $result;
    }
}
