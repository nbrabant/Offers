<?php

namespace Nbrabant\Offers\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner as BannerResourceModel;

/**
 * Class Banner
 */
class Banner extends AbstractModel implements BannerInterface, IdentityInterface
{
    const CACHE_TAG = 'nbrabant_offers_banner';

    protected $_cacheTag = 'nbrabant_offers_banner';

    protected $_eventPrefix = 'nbrabant_offers_banner';

    /**
     * Store matched product Ids
     *
     * @var array
     */
    protected $categoryIds;

    protected function _construct()
    {
        $this->_init(BannerResourceModel::class);
        $this->setIdFieldName(BannerResourceInterface::BANNER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): string
    {
        return $this->getData(BannerResourceInterface::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setLabel(string $label): BannerInterface
    {
        return $this->setData(BannerResourceInterface::LABEL, $label);
    }

    /**
     * @inheritDoc
     */
    public function getImageSrc(): string
    {
        return $this->getData(BannerResourceInterface::IMAGE_SRC);
    }

    /**
     * @inheritDoc
     */
    public function setImageSrc(string $imageSrc): BannerInterface
    {
        return $this->getData(BannerResourceInterface::IMAGE_SRC, $imageSrc);
    }

    /**
     * @inheritDoc
     */
    public function getLink(): string
    {
        return $this->getData(BannerResourceInterface::LINK);
    }

    /**
     * @inheritDoc
     */
    public function setLink(string $link): BannerInterface
    {
        return $this->setData(BannerResourceInterface::LINK, $link);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryIds(): string
    {
        return $this->getData(BannerResourceInterface::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryIds(string $categoryIds): BannerInterface
    {
        return $this->setData(BannerResourceInterface::CATEGORY_IDS, $categoryIds);
    }

    /**
     * @inheritDoc
     */
    public function getFromDate(): \DateTimeInterface
    {
        return $this->getData(BannerResourceInterface::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setFromDate(\DateTimeInterface $fromDate): BannerInterface
    {
        return $this->setData(BannerResourceInterface::FROM_DATE, $fromDate);
    }

    /**
     * @inheritDoc
     */
    public function getToDate(): ?\DateTimeInterface
    {
        return $this->getData(BannerResourceInterface::LABEL);
    }

    /**
     * @inheritDoc
     */
    public function setToDate(?\DateTimeInterface $toDate): BannerInterface
    {
        return $this->setData(BannerResourceInterface::TO_DATE, $toDate);
    }
}
