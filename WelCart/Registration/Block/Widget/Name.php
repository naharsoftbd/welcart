<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace WelCart\Registration\Block\Widget;

class Name
{
    public function after_construct(\Magento\Customer\Block\Widget\Name $result)
    {
        $result->setTemplate('WelCart_Registration::widget/name.phtml');
        return $result;
    }
}

