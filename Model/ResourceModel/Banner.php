<?php

namespace Nbrabant\Offers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Nbrabant\Offers\Api\Data\BannerResourceInterface;

/**
 * Class Banner
 * @package Nbrabant\Offers\Model\ResourceModel
 */
class Banner extends AbstractDb implements BannerResourceInterface
{
    /**
     *  Initialize main table and table id field
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::BANNER_ID);
    }

}
