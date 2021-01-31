<?php

namespace Nbrabant\Offers\Block\Adminhtml\Banner\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\View\Element\UiComponent\Context;

class Back implements ButtonProviderInterface
{

    /**
     * @var Context
     */
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl(): string
    {
        return $this->context->getUrl('*/*/');
    }
}
