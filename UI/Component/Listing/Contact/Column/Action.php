<?php
/**
 * class Action
 *
 * @category  Slavik\Contact\UI\Component\Listing;
 * @package   Slavik\Contact
 * @author    Stanislav Lelyuk <lelyuk.stanislav@gmail.com>
 * @copyright 2018 Stanislav Lelyuk
 */

namespace Slavik\Contact\UI\Component\Listing\Contact\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;


class Action extends Column
{
    /** Url path */
    const ROW_EDIT_URL = 'slavik_contact/contact/answer';

    /**
     * Url Builder
     *
     * @var Magento\Framework\UrlInterface;
     */
    protected $_urlBuilder;

    /**
     * Edit Url
     *
     * @var string
     */
    private $_editUrl;

    /**
     * Action constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL
    )
    {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['contact_id'])) {
                    $item[$name]['answer'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['id' => $item['contact_id']]
                        ),
                        'label' => __('Answer'),
                    ];
                }
            }
        }
        return $dataSource;
    }
}


