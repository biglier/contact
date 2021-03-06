<?php
/**
 * class Form for loking information about contact,saving or deleting it
 *
 * @category  Slavik\Contact\Block\Adminhtml\Answer;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\Block\Adminhtml\Answer\Edit;

use Slavik\Contact\Model\Contact;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * System store
     *
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Slavik\Contact\Model\IsAnswered $options
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Slavik\Contact\Model\IsAnswered $options,
        array $data = []
    )
    {
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init Form
     */
        protected function _construct()
        {
            parent::_construct();
            $this->setId('edit_form');
            $this->setTitle(__('Contact Information'));
        }

    /**
     * Prepare form
     *
     * @return \Magento\Backend\Block\Widget\Form\Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var Contact $model */
        $model = $this->_coreRegistry->registry('row_data');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form',
                'enctype' => 'multipart/form-data',
                'action' => $this->getData('action'),
                'method' => 'post'
            ]
            ]
        );

        $form->setHtmlIdPrefix('slavik_contact_');
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Contact Info'), 'class' => 'fieldset-wide']
        );
        $fieldset->addField('contact_id', 'hidden', ['name' => 'id']);

        $fieldset->addField(
            'customer_name',
            'label',
            [
                'name' => 'customer_name',
                'label' => __('Customer Name')
            ]
        );
        $fieldset->addField(
            'customer_email',
            'label',
            [
                'name' => 'customer_email',
                'label' => __('Customer Email'),
                'id' => 'title',
                'title' => __('Title'),
            ]
        );
        $fieldset->addField(
            'text',
            'label',
            [
                'name' => 'text',
                'label' => __('Text'),
                'id' => 'title',
                'title' => __('Title'),
            ]
        );
        $fieldset->addField(
            'answer',
            'textarea',
            [
                'name' => 'answer',
                'label' => __('Answer'),
                'id' => 'answer',
                'title' => __('Answer text'),
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}