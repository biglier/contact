<?php
/**
 * class Save for saving answer
 *
 * @category  Slavik\Contact\Controller\Adminhtml
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Slavik\Contact\Model\Contact;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;

class Save extends \Magento\Backend\App\Action
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