<?php

namespace Nbrabant\Offers\Controller\Adminhtml\Banners;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Magento\Backend\App\Action\Context;
use Psr\Log\LoggerInterface;

class NewAction extends Action
{
    const ADMIN_RESOURCE = 'Nbrabant_Offers::offers_banner';
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * NewAction constructor.
     * @param Context $context
     * @param BannerRepositoryInterface $bannerRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        BannerRepositoryInterface $bannerRepository,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository;
        $this->logger = $logger;
    }

    /**
     * @return Page|ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        try {
            $bannerDatas = $this->getRequest()->getParam('banner');
            if (is_array($bannerDatas)) {
                $this->bannerRepository->create($bannerDatas);
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
