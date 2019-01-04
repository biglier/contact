<?php
/**
 * class Delete for deleting contact
 *
 * @category  Slavik\Contact\Controller\Adminhtml
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Setup\Exception;
use Slavik\Contact\Model\ContactRepository;

class Delete extends \Magento\Backend\App\Action
{

    /**
     * Contact Repository
     *
     * @var Slavik\Contact\Model\ContactRepository
     */
    protected $contactRepository;

    /**
     * Answer constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        Context $context,
        ContactRepository $contactRepository
    )
    {
        parent::__construct($context);
        $this->contactRepository = $contactRepository;
    }

    /**
     * Delete contact
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        /** @var int $id */
        $id = $this->getRequest()->getParam('id');
        if (!($contact = $this->contactRepository->getById($id))) {
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
        $this->_redirect('slavik_contact/post/index');
    }
}