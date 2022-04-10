<?php

namespace WelCart\REgistration\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {

    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    public function __construct(CustomerSetupFactory $customerSetupFactory) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
        $setup->startSetup();
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerSetup->addAttribute(Customer::ENTITY, 'customer_mobile', [
            'label' => 'Customer Mobile',
            'input' => 'text',
            'required' => true,
            'sort_order' => 40,
            'visible' => true,
            'system' => false,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'is_searchable_in_grid' => true]
        );

        // add attribute to form
        /** @var  $attribute */
        // Main program
        $n = 6;
        $otp = generateNumericOTP($n)
        $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'customer_mobile');
        $attribute->setData('used_in_forms', ['adminhtml_customer', 'customer_account_create']);
        $attribute->save();

        $setup->endSetup();
    }


// Function to generate OTP
function generateNumericOTP($n) {
    
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";

    // Iterate for n-times and pick a single character
    // from generator and append it to $result
    
    // Login for generating a random character from generator
    //   ---generate a random number
    //   ---take modulus of same with length of generator (say i)
    //   ---append the character at place (i) from generator to result

    $result = "";

    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }

    // Return result
    return $result;
}


}
