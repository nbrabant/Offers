<?php

namespace Nbrabant\Offers\Model;

use Magento\Framework\Model\AbstractModel;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;
use Nbrabant\Offers\Model\ResourceModel\BannerResource as BannerResourceModel;

/**
 * Class Banner
 */
class Banner extends AbstractModel
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
