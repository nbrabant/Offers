<?php

namespace Nbrabant\Offers\Ui\Component\Listing\Column\Banner;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    const NAME = 'image_src';

    const ALT_FIELD = 'label';

    /**
     * Thumbnail constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $banner = new DataObject($item);
                $item[$fieldName . '_src'] = $banner->getImageSrc();
                $item[$fieldName . '_alt'] = $banner->getLabel() ?? $banner->getImageSrc();
                $item[$fieldName . '_link'] = $banner->getLink();
            }
        }

        return $dataSource;
    }

}
