<?php

/**
 * class Post
 *
 * @category  Slavik\Contact\Block\Adminhtml;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */
namespace  Slavik\Contact\Block\Adminhtml;

class Post extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     *
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Slavik_Contact';
        $this->_headerText = __('Contacts');
        $this->_addButtonLabel = __('Answer contacts');
        parent::_construct();
    }
}