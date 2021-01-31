<?php

namespace Nbrabant\Offers\Model\ResourceModel\Banner;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Nbrabant\Offers\Model\Banner;
use Nbrabant\Offers\Model\ResourceModel\Banner as BannerResource;

/**
 * Class Collection
 * @package Nbrabant\Offers\Model\ResourceModel\Banner
 */
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Banner::class, BannerResource::class);
    }
}
