<?php

namespace Nbrabant\Offers\Controller\Adminhtml\Banners;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Exception\OfferBannerNotFoundException;
use Nbrabant\Offers\Exception\OfferWrongParameterException;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Nbrabant_Offers::offers_banner';
    /**
     * @var BannerRepositoryInterface
     */
    private $bannerRepository;

    public function __construct(
        Context $context,
        BannerRepositoryInterface $bannerRepository
    ) {
        parent::__construct($context);
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * @return Page
     * @throws OfferBannerNotFoundException
     * @throws OfferWrongParameterException
     */
    public function execute()
    {
        $bannerId = (int)$this->getRequest()->getParam('id');
        if (!$bannerId) {
            throw new OfferWrongParameterException(__('Wrong parameter passed for banner'));
        }

        $banner = $this->bannerRepository->findById($bannerId);
        if (!$banner->getId()) {
            throw new OfferBannerNotFoundException(__('Unable to find banner with in #[%1]', $bannerId));
        }

        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $resultPageTitle = $banner->getLabel() . ' (ID: ' . $bannerId . ')';
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__('Banners'));
        $resultPage->getConfig()->getTitle()->prepend($resultPageTitle);
        $resultPage->addBreadcrumb(__('Manage Offers Banners'), __('Manage Banners'));

        return $resultPage;
    }

}
