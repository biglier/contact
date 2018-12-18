<?php
/**
 * Created by PhpStorm.
 * User: slava
 * Date: 05.12.18
 * Time: 14:53
 */

namespace Slavik\Contact\Block\Adminhtml\Contact;


class Answer extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry.
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
        return __('Answer Contact');
    }

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
        return $this->getUrl('*/*/save');
    }

    /**
     * Init form
     */
    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Slavik_Contact';
        $this->_controller = 'adminhtml_answer';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->remove('reset');
        $this->buttonList->remove('back');

    }

}