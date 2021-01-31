<?php

namespace Nbrabant\Offers\Ui\DataProvider\Banners;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nbrabant\Offers\Model\ResourceModel\Banner\CollectionFactory;

class BannersDataProvider extends AbstractDataProvider
{
    /**
     * @var \Nbrabant\Offers\Model\ResourceModel\Banner\Collection
     */
    protected $collection;

    /**
     * BannersDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
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

}
