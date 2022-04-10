<?php

namespace WelCart\Registration\Observer;

use Magento\Framework\Event\ObserverInterface;

class RegisterAfter implements ObserverInterface
{
    protected $_responseFactory;

    protected $_redirect;

    protected $_url;

    public function __construct(
        \Magento\Framework\View\Element\BlockFactory $blockFactory,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Response\Http $redirect
    ) {
        $this->_responseFactory = $responseFactory;
        $this->_url = $url;
        $this->_redirect = $redirect;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customRedirectionUrl = $this->_url->getUrl('verify_otp/page/view');
        $this->_responseFactory->create()->setRedirect($customRedirectionUrl)->sendResponse();
        die();           
    }
}
