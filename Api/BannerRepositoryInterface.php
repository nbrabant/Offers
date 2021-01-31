<?php

namespace Nbrabant\Offers\Api;

use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner\Collection;

interface BannerRepositoryInterface
{
    /**
     * Find Banner from repository Id
     * @param $id
     * @return BannerInterface
     */
    public function findById($id): BannerInterface;

    /**
     * Find all banners
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Create banner from data
     * @param $bannerData
     * @return BannerInterface
     */
    public function create($bannerData): BannerInterface;
}
