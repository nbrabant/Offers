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
        parent::_construct();
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

}
