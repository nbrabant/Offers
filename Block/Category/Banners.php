<?php

namespace Nbrabant\Offers\Block\Category;

use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;

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
     * @var SearchCriteriaBuilder
     */
    private $criteriaBuilder;
    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * Banners constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param BannerRepositoryInterface $bannerRepository
     * @param SearchCriteriaBuilder $criteriaBuilder
     * @param FilterGroupBuilder $filterGroupBuilder ,
     * @param FilterBuilder $filterBuilder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Registry $registry,
        BannerRepositoryInterface $bannerRepository,
        SearchCriteriaBuilder $criteriaBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        FilterBuilder $filterBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->bannerRepository = $bannerRepository;
        $this->registry = $registry;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * Get actives banners for current category
     *
     * @return array
     * @throws \Exception
     */
    public function getBanners(): array
    {
        $filters[] = $this->filterBuilder
            ->setField(BannerResourceInterface::TO_DATE)
            ->setValue('null');
        $filters[] = $this->filterBuilder
            ->setField(BannerResourceInterface::TO_DATE)
            ->setValue('null');

        $criteriaBuilder = $this->criteriaBuilder
            ->addFilter(
                BannerResourceInterface::CATEGORY_IDS,
                [$this->getCurrentCategory()->getId()],
                'in'
            )
            ->addFilter(
                BannerResourceInterface::FROM_DATE,
                new \DateTime(),
                'lt'
            )
//            ->setFilterGroups([
//                $this->filterGroupBuilder
//                    ->setFilters($filters)
//                    ->create()
//            ])
            ->create();

        return $this->bannerRepository->getList($criteriaBuilder);
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
