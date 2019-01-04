<?php
/**
 * class Answer for binding buttons
 *
 * @category  Slavik\Contact\Block\Adminhtml;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Block\Adminhtml\Answer;

use Magento\Backend\Block\Widget\Form\Container;

class Answer extends Container
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
     * @return string
     */
    public function getDeleteUrl()
    {
        //returning Contact_id for deleting it
        return $this->getUrl('*/*/delete', ['id'=>$this->_coreRegistry->registry('row_data')->getId()]);
    }

    /**
     * Init form & buttons
     */
    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Slavik_Contact';
        $this->_controller = 'adminhtml_answer';
        parent::_construct();
        $this->buttonList->remove('reset');
        $this->buttonList->remove('back');
        $this->buttonList->add(
            'delete',
            [
                'label' => __('Delete'),
                'class' => 'delete',
                'onclick' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')'
            ]
        );
    }

}