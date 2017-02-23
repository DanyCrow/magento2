<?php

namespace Training\Seller\Controller\Adminhtml\Seller;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Training\Seller\Model\SellerFactory;

abstract class AbstractAction extends Action
{

    /**
     * Model Factory
     *
     * @var SellerFactory
     */
    protected $modelFactory;


    /**
     * AbstractAction constructor.
     * @param Context $context
     * @param SellerFactory $modelFactory
     */
    public function __construct(
        Context $context,
        SellerFactory $modelFactory
    ) {
        parent::__construct($context);

        $this->modelFactory = $modelFactory;
    }

    /**
     * Check is allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_Seller::manage');
    }

}
