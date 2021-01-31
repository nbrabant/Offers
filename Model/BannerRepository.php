<?php

namespace Nbrabant\Offers\Model;

use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Exception\OfferBannerSaveException;
use Nbrabant\Offers\Model\ResourceModel\Banner\Collection;
use Nbrabant\Offers\Model\ResourceModel\Banner\CollectionFactory;

/**
 * Class BannerRepository
 * @package Nbrabant\Offers\Model
 */
class BannerRepository implements BannerRepositoryInterface
{
    /**
     * @var BannerFactory
     */
    private $bannerFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * BannerRepository constructor.
     * @param BannerFactory $bannerFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        BannerFactory $bannerFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Find Banner from repository Id
     * @param $id
     * @return BannerInterface
     */
    public function findById($id): BannerInterface
    {
        return $this->bannerFactory->create()->load($id);
    }

    /**
     * Find all banners
     * @return Collection
     */
    public function getAll(): Collection
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Create banner from data
     * @param $bannerData
     * @return BannerInterface
     * @throws OfferBannerSaveException
     */
    public function create($bannerData): BannerInterface
    {
        $banner = $this->bannerFactory->create($bannerData);

        if ($banner->save()) {
            return $banner;
        }

        throw new OfferBannerSaveException(__('Unable to create new banner'));
    }
}
