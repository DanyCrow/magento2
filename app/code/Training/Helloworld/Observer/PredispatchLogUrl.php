<?php
/**
 * Magento 2 Training Project
 * Module Training/Helloworld
 */
namespace Training\Helloworld\Observer;

use Magento\Framework\Event\ObserverInterface;

class PredispatchLogUrl implements ObserverInterface
{

    /**
     * Object logger
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;


    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    /**
     * Log current path info in ./var/log/debug.log
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getRequest()->getPathInfo();

        //$this->logger->debug(__METHOD__);
        //$this->logger->debug($request);

        return $this;
    }

}
