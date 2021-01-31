<?php

namespace Nbrabant\Offers\Controller\Adminhtml\Banners;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        echo '<pre>';
        var_dump('hello the world!');
        echo '</pre>';
        die;
    }
}
