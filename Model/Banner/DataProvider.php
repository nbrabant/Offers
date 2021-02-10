<?php

namespace Nbrabant\Offers\Model\Banner;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nbrabant\Offers\Model\ResourceModel\Banner\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    private $loadedData = [];

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $banners = $this->collection->getItems();
        foreach ($banners as $banner) {
            $this->loadedData[$banner->getId()]['banner'] = $banner->getData();
        }

        return $this->loadedData;
    }
}
