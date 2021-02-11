<?php

namespace Nbrabant\Offers\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Nbrabant\Offers\Api\Data\BannerInterface;

interface BannerRepositoryInterface
{
    /**
     * Save banner from data
     * @param BannerInterface $banner
     * @return BannerInterface
     */
    public function save(BannerInterface $banner): BannerInterface;

    /**
     * Find Banner from repository Id
     * @param int $id
     * @return BannerInterface
     */
    public function get(int $id): BannerInterface;

    /**
     * Find all banners
     * @param SearchCriteriaInterface $searchCriteria
     * @return BannerInterface[]
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array;

    /**
     * Delete banner
     * @param BannerInterface $banner
     * @return bool
     */
    public function delete(BannerInterface $banner): bool;

    /**
     * Delete banner by identifier
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
