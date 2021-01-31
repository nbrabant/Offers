<?php

namespace Nbrabant\Offers\Model\Banner;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var array
     */
    private $loadedData = [];
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        BannerRepositoryInterface $bannerRepository,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->bannerRepository = $bannerRepository;
        $this->collection = $collectionFactory->create();
    }

    public function getData(): array
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $banners = $this->bannerRepository->getAll();
        foreach ($banners as $banner) {
            $this->loadedData[$banner->getId()]['banner'] = $banner->getData();
        }

        return $this->loadedData;
    }
}
