<?php
/**
 * class Answer
 *
 * @category  Slavik\Contact\Controller\Adminhtml
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Controller\Adminhtml\Contact;

use Magento\Framework\Controller\ResultFactory;
use Slavik\Contact\Model\Contact;
use Slavik\Contact\Model\ContactFactory;

class Answer extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Contact Factory
     *
     * @var Slavik\Contact\Model\ContactFactory
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
        ContactFactory $contactFactory
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
        /** @var int $id */
        $id = (int)$this->getRequest()->getParam('id');

        /** @var Contact $contact */
        $contact = $this->contactFactory->create();

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($id) {
            $contact = $contact->load($id);
            if (!$contact->getId()) {
                $this->messageManager->addError(__('contact no longer exist.'));
                $this->_redirect('slavik_contact/post/index');
                return;
            }
        }
        $this->coreRegistry->register('row_data', $contact);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = 'Answer Contact';
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

}