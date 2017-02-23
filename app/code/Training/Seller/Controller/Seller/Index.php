<?php

namespace Training\Seller\Controller\Seller;


/**
 * Action: Index/Index
 */
class Index extends AbstractAction
{


    /**
     * Execute the action
     *
     * @return void
     */
    public function execute()
    {
        //$this->getResponse()->appendBody('Hello World !');

        $html = $this->getSellersHtml();
        $this->getResponse()->appendBody($html);

    }

    /**
     * @return string $html
     */
    protected function getSellersHtml()
    {
        $sellers = $this->sellerRepository->getList()->getItems();

        $html = "<ul>";
        foreach ($sellers as $seller) {
            $html .= '<li><a href="/seller/'.$seller->getIdentifier().'.html">'.$seller->getName().'</a></li>';
        }
        $html .= "<ul/>";
        return $html;
    }

}
