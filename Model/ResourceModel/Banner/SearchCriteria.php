<?php

namespace Nbrabant\Offers\Model\ResourceModel\Banner;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;

class SearchCriteria
{
    /**
     * @var SearchCriteriaBuilderFactory
     */
    private $criteriaBuilderFactory;
    /**
     * @var FilterGroupBuilder
     */
    private $filterGroupBuilder;
    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    public function __construct(
        SearchCriteriaBuilderFactory $criteriaBuilderFactory,
        FilterGroupBuilder $filterGroupBuilder,
        FilterBuilder $filterBuilder
    ) {
        $this->criteriaBuilderFactory = $criteriaBuilderFactory;
        $this->filterGroupBuilder = $filterGroupBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * @param int $categoryId
     * @param \DateTimeInterface $dateTime
     * @return SearchCriteriaInterface
     */
    public function activeForCategoryCriteria(
        int $categoryId,
        \DateTimeInterface $dateTime
    ): SearchCriteriaInterface {
        $searchCriteriaBuilder = $this->criteriaBuilderFactory->create();
        $this->addPublishingCriteria($searchCriteriaBuilder, $dateTime);
        $this->addCategoryCriteria($searchCriteriaBuilder, $categoryId);

        return $searchCriteriaBuilder->create();
    }

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param int $categoryId
     */
    private function addCategoryCriteria(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        int $categoryId
    ): void {
        $searchCriteriaBuilder->addFilter(
            BannerResourceInterface::CATEGORY_IDS,
            [$categoryId],
            'in'
        );
    }

    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \DateTimeInterface $dateTime
     */
    private function addPublishingCriteria(
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \DateTimeInterface $dateTime
    ): void {
        $searchCriteriaBuilder->setFilterGroups([
            $this->filterGroupBuilder
                ->setFilters([
                    $this->filterBuilder
                        ->setField(BannerResourceInterface::TO_DATE)
                        ->setConditionType('null')
                        ->create(),
                    $this->filterBuilder
                        ->setField(BannerResourceInterface::TO_DATE)
                        ->setValue($dateTime)
                        ->setConditionType('gteq')
                        ->create()
                ])
                ->create()
        ]);
        $searchCriteriaBuilder->addFilter(
            BannerResourceInterface::FROM_DATE,
            $dateTime,
            'lteq'
        );
    }

}
