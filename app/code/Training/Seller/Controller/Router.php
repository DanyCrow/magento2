<?php
namespace Training\Seller\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    /** @var ActionFactory  */
    protected $actionFactory;

    /**
     * Router constructor.
     * @param ActionFactory $actionFactory
     */
    public function __construct(
        ActionFactory $actionFactory
    ) {
        $this->actionFactory = $actionFactory;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function match(RequestInterface $request)
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $info = $request->getPathInfo();

        if (preg_match('%^/seller/(.*?)\.html$%', $info, $match)) {
            $request->setPathInfo(sprintf('/seller/seller/view/identifier/%s', $match[1]));
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        if ($info == '/sellers.html') {
            $request->setPathInfo('/seller/seller/index');
            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }

        return null;
    }

}