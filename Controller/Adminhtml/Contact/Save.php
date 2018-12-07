<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 07.12.18
 * Time: 14:15
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;


class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Slavik\Contact\Model\ContactFactory
     */
    var $contactFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Slavik\Contact\Model\ContactFactory $contactFactory
     */
    public function __construct(
    \Magento\Backend\App\Action\Context $context,
    \Slavik\Contact\Model\ContactFactory $contactFactory
) {
    parent::__construct($context);
    $this->contactFactory = $contactFactory;
}

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
{
    $data = $this->getRequest()->getPostValue();
    if (!$data) {
        $this->_redirect('/slavik_contact/contact/answer');
        return;
    }
    try {
        $contact = $this->contactFactory->create();
        $contact=$contact->load($data['id']);
        $contact->setAnswer($data['answer']);
        $contact->save();
        $this->messageManager->addSuccess(__('Answer has been successfully saved.'));
    } catch (\Exception $e) {
        $this->messageManager->addError(__($e->getMessage()));
    }
    $this->_redirect('slavik_contact/post/index');
}

}