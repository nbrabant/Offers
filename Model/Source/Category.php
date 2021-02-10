<?php

namespace Nbrabant\Offers\Model\Source;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class Category implements OptionSourceInterface
{

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Category constructor.
     * @param CollectionFactory $collectionFactory
     * @param CategoryRepositoryInterface $categoryRepository
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function toOptionArray()
    {
        $optionArray = [];

        $rootCategory = $this->getRootCategory();

        $categoriesOptions = $this->getChildrens(
            $rootCategory->getId(),
            $rootCategory->getLevel() +1
        );
        foreach ($categoriesOptions as $value => $label) {
            $optionArray[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $optionArray;
    }

    /**
     * Retrieve child categories
     *
     * @param int $parentCategoryId
     * @param int $level
     * @return array
     * @throws LocalizedException
     */
    private function getChildrens(int $parentCategoryId, int $level): array
    {
        $collection = $this->collectionFactory->create()
            ->addAttributeToSelect('name')
            ->addAttributeToFilter('level', $level)
            ->addAttributeToFilter('parent_id', $parentCategoryId)
            ->addAttributeToFilter('is_active', 1)
            ->setOrder('position', 'asc');

        $options = [];
        /**
         * @var CategoryInterface $category
         */
        foreach ($collection as $category) {
            if ($category->getLevel() > 1) {
                $options[$category->getLevel()] =
                    \str_pad($category->getName(), ($category->getLevel() * 3), '. ', STR_PAD_LEFT);
            }

            if ($category->hasChildren()) {
                $options = \array_merge($options, $this->getChildrens(
                    $category->getId(),
                    $category->getLevel() + 1
                ));
            }
        }

        return $options;
    }

    /**
     * Retrieve root category
     *
     * @return CategoryInterface
     * @throws NoSuchEntityException
     */
    private function getRootCategory(): CategoryInterface
    {
        return $this->categoryRepository->get(
            $this->storeManager->getStore()->getRootCategoryId()
        );
    }
}
