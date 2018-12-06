<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 29.11.18
 * Time: 22:30
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;

use Magento\Setup\Exception;
use Slavik\Contact\Model\Contact;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($contact = $this->_objectManager->create(Contact::class)->load($id))) {
            $this->messageManager->addError(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try{
            $contact->delete();
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