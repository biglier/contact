<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 29.11.18
 * Time: 22:30
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Setup\Exception;
use Slavik\Contact\Model\ContactFactory;
use Slavik\Contact\Model\ContactRepository;

class Delete extends \Magento\Backend\App\Action
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
     * Answer constructor.
     * @param \Magento\Backend\App\Action\Context $context
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

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (!($contact = $this->contactFactory->create($this->contactRepository->getById($id)))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try {
            $this->contactRepository->delete($contact);
            $this->messageManager->addSuccess(__('Your contact has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Error while trying to delete contact: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}