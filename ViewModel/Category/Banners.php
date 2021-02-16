<?php

namespace Nbrabant\Offers\ViewModel\Category;

use Magento\Framework\Registry;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner\SearchCriteria;

class Banners implements ArgumentInterface
{
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;
    /**
     * @var SearchCriteria
     */
    private $searchCriteria;

    public function __construct(
        Registry $registry,
        BannerRepositoryInterface $bannerRepository,
        SearchCriteria $searchCriteria
    ) {
        $this->registry = $registry;
        $this->bannerRepository = $bannerRepository;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Get actives banners for current category
     *
     * @return BannerInterface[]
     * @throws \Exception
     */
    public function getBanners(): array
    {
        $searchCriteria = $this->searchCriteria->activeForCategoryCriteria(
            $this->getCurrentCategory()->getId(),
            new \DateTime()
        );

        return $this->bannerRepository->getList($searchCriteria);
    }

    /**
     * @return CategoryInterface
     */
    public function getCurrentCategory(): CategoryInterface
    {
        return $this->registry->registry('current_category');
    }

}
