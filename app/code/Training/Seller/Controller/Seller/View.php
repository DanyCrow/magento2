<?php
namespace Training\Seller\Controller\Seller;

use Magento\Framework\Exception\NoSuchEntityException;

class View extends AbstractAction
{

    /**
     * Execute the action
     *
     * @return \Magento\Framework\View\Result\Page|null
     */
    public function execute()
    {
        // get the asked identifier
        $identifier = trim($this->getRequest()->getParam('identifier'));
        if (!$identifier) {
            $this->_forward('noroute');
            return null;
        }

        // get the asked seller
        try {
            $seller = $this->sellerRepository->getByIdentifier($identifier);
        } catch (NoSuchEntityException $e) {
            $this->_forward('noroute');
            return null;
        }

        $this->registry->register('current_seller', $seller);

        // Display the page using layout
        $resultPage = $this->resultPageFactory->create();

        // Page name is written by controller, not by blocks because they are many
        $resultPage->getConfig()->getTitle()->set(__('Seller "%1"', $seller->getName()));

        return $resultPage;
    }
}
