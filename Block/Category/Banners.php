<?php

namespace Nbrabant\Offers\Block\Category;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner\SearchCriteria;

class Banners extends Template
{
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var SearchCriteria
     */
    private $searchCriteria;

    /**
     * Banners constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param BannerRepositoryInterface $bannerRepository
     * @param SearchCriteria $searchCriteria
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        BannerRepositoryInterface $bannerRepository,
        SearchCriteria $searchCriteria,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerRepository = $bannerRepository;
        $this->registry = $registry;
        $this->searchCriteria = $searchCriteria;
    }

    /**
     * Get actives banners for current category
     *
     * @return array
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
     * Retrieve current category
     *
     * @return CategoryInterface
     */
    private function getCurrentCategory(): CategoryInterface
    {
        return $this->registry->registry('current_category');
    }
}
