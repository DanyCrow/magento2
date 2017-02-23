<?php

namespace Training\Seller\Controller\Adminhtml\Seller;

class Index extends AbstractAction
{

    public function execute()
    {
        // Note: in admin we can not use repository, not in Magento 2.1, maybe later...
        $model = $this->modelFactory->create();
        $model->getResource()->load($model, 1);

        echo '<pre>';
        print_r($model->getData());
        echo '</pre>';

    }

}
