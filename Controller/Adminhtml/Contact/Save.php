<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 07.12.18
 * Time: 14:15
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;


use Magento\Backend\App\Action\Context;
use Slavik\Contact\Model\Contact;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;

//Saving answer
class Save extends \Magento\Backend\App\Action
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
     * Save constructor.
     * @param Context $context
     * @param ContactFactory $contactFactory
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        Context $context,
        ContactFactory $contactFactory,
        ContactRepository $contactRepository
    )
    {
        parent::__construct($context);
        $this->contactFactory = $contactFactory;
        $this->contactRepository = $contactRepository;

    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/answer');
            return;
        }
        try {

            /** @var Contact $contact */
            $contact = $this->contactRepository->getById($data['id']);
            $contact->setAnswer($data['answer']);
            $contact->setAnsweredStatus(true);
            $this->contactRepository->save($contact);
            $this->messageManager->addSuccess(__('Answer has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('slavik_contact/post/index');
    }

}