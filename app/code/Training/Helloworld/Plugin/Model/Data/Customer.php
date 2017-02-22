<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Plugin\Model\Data;

class Customer
{

    public function beforeSetFirstname(\Magento\Customer\Model\Data\Customer $customer, $firstname)
    {
        $firstname = mb_convert_case($firstname, MB_CASE_TITLE);

        return [$firstname];
    }

}