<?php

namespace Nbrabant\Offers\Model;

use Magento\Framework\Model\AbstractModel;
use Nbrabant\Offers\Api\Data\BannerInterface;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;
use Nbrabant\Offers\Model\ResourceModel\Banner as BannerResourceModel;

/**
 * Class Banner
 */
class Banner extends AbstractModel implements BannerInterface
{
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

}
