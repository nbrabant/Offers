<?php

namespace Nbrabant\Offers\Test\Unit\Controller\Adminhtml\Banners;

use Nbrabant\Offers\Api\BannerRepositoryInterface;
use Nbrabant\Offers\Controller\Adminhtml\Banners\Edit;
use Nbrabant\Offers\Exception\OfferBannerNotFoundException;
use Nbrabant\Offers\Exception\OfferWrongParameterException;
use Nbrabant\Offers\Model\Banner;
use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class EditTest extends TestCase
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var Edit
     */
    private $editController;
    /**
     * @var \Magento\Framework\App\Request\Http\Proxy|\PHPUnit\Framework\MockObject\MockObject
     */
    private $requestMock;
    /**
     * @var \Magento\Framework\ObjectManager\ContextInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;
    /**
     * @var BannerRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $bannerRepositoryMock;

    protected function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);

        $this->requestMock = $this->getMockBuilder(
            \Magento\Framework\App\Request\Http\Proxy::class
        )->disableOriginalConstructor()
            ->setMethods(['getParam'])
            ->getMockForAbstractClass();

        $this->contextMock = $this->getMockBuilder(
            \Magento\Backend\App\Action\Context::class
        )->disableOriginalConstructor()
            ->setMethods(['getRequest'])
            ->getMockForAbstractClass();
        $this->contextMock->method('getRequest')
            ->willReturn($this->requestMock);

        $this->bannerRepositoryMock = $this->getMockBuilder(
            BannerRepositoryInterface::class
        )->disableOriginalConstructor()
            ->setMethods(['findById'])
            ->getMockForAbstractClass();

        $this->editController = $this->objectManager->getObject(Edit::class, [
            'context' => $this->contextMock,
            'bannerRepository' => $this->bannerRepositoryMock
        ]);
    }

    public function testItShouldThrowExceptionWhenBannerIdIsMissing()
    {
        $this->expectException(OfferWrongParameterException::class);
        $this->expectExceptionMessage('Wrong parameter passed for banner');

        $this->requestMock->method('getParam')
            ->willReturn(null);

        $this->editController->execute();
    }

    public function testItShouldThrowExceptionWhenBannerNotExists()
    {
        $this->expectException(OfferBannerNotFoundException::class);
        $this->expectExceptionMessage('Unable to find banner with in #[1]');

        $this->requestMock->method('getParam')
            ->willReturn(1);

        $this->bannerRepositoryMock->method('findById')
            ->willReturn($this->objectManager->getObject(Banner::class));

        $this->editController->execute();
    }
}
