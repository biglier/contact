<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 05.12.18
 * Time: 14:46
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;


use Magento\Framework\Controller\ResultFactory;
use Slavik\Contact\Model\ContactFactory;

class Answer extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * Answer constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Slavik\Contact\Model\ContactFactory $contactFactory
    )
    {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->contactFactory = $contactFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int)$this->getRequest()->getParam('id');
        $rowData = $this->contactFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('slavik_contact/post/index');
                return ;
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = 'Answer Contact';
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

}