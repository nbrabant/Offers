<?php

namespace Nbrabant\Offers\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Exception\OfferBannerSaveException;
use Nbrabant\Offers\Model\ResourceModel\Banner as BannerResource;
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
     * @var BannerResource
     */
    private $bannerResource;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * BannerRepository constructor.
     * @param BannerFactory $bannerFactory
     * @param BannerResource $bannerResource
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        BannerFactory $bannerFactory,
        BannerResource $bannerResource,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->bannerResource = $bannerResource;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Find Banner from repository Id
     * @param int $id
     * @return BannerInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): BannerInterface
    {
        $banner = $this->bannerFactory->create()
            ->load($id);
        if (!$banner->getId()) {
            throw new NoSuchEntityException(
                __('Unable to get banner for id [%1]', $id)
            );
        }

        return $banner;
    }

    /**
     * Save banner from data
     * @param BannerInterface $banner
     * @return BannerInterface
     * @throws NoSuchEntityException
     * @throws OfferBannerSaveException
     */
    public function save(BannerInterface $banner): BannerInterface
    {
        try {
            $this->bannerResource->save($banner);
        } catch (\Exception $e) {
            throw new OfferBannerSaveException(
                __('Could not save banner: [%1]', $e->getMessage()),
                $e
            );
        }

        return $this->get($banner->getId());
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): array
    {
        /**
         * @var Collection $collection
         */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        return $collection->getItems();
    }

    /**
     * @inheritDoc
     * @throws StateException
     */
    public function delete(BannerInterface $banner): bool
    {
        try {
            $this->bannerResource->delete($banner);
        } catch (\Exception $e) {
            throw new StateException(
                __(
                    'Cannot delete category with id %1',
                    $banner->getId()
                ),
                $e
            );
        }
        return true;
    }

    /**
     * @inheritDoc
     * @param int $id
     * @return bool
     * @throws NoSuchEntityException
     * @throws StateException
     */
    public function deleteById(int $id): bool
    {
        $banner = $this->get($id);
        return $this->delete($banner);
    }
}
