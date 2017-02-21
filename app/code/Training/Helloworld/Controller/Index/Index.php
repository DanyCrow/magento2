<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Controller\Index;

/**
 * Action: Index/Index
 */
class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        $this->getResponse()->appendBody('Hello World !');
    }
}
