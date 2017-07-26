<?php

/**
 * Free product salesrule
 *
 * @category   LCB
 * @package    LCB_FreeProduct
 * @author     Silpion Tomasz Gregorczyk <tom@lcbrq.com>
 */

namespace LCB\FreeProduct\Model\Rule\Action\Gift;

class Product extends \Magento\SalesRule\Model\Rule\Action\Discount\AbstractDiscount {

    /**
     * @var \Magento\SalesRule\Model\Rule\Action\Discount\DataFactory
     */
    protected $discountFactory;

    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $_productRepository;

    /**
     * @var \Magento\Checkout\Model\Cart
     */
    protected $_cart;

    public function __construct(
            \Magento\SalesRule\Model\Rule\Action\Discount\DataFactory $discountDataFactory,
            \Magento\Catalog\Model\ProductRepository $productRepository, 
            \Magento\Checkout\Model\Cart $cart
    )
    {
        $this->discountFactory = $discountDataFactory;
        $this->_productRepository = $productRepository;
        $this->_cart = $cart;
    }

    /**
     * @param \Magento\SalesRule\Model\Rule $rule
     * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param float $qty
     * @return \Magento\SalesRule\Model\Rule\Action\Discount\Data
     */
    public function calculate($rule, $item, $qty)
    {

        /** @var \Magento\SalesRule\Model\Rule\Action\Discount\Data $discountData */
        $discountData = $this->discountFactory->create();

        $freeProductId = (int) $rule->getDiscountAmount();

        if ($freeProductId) {

            $normalProducts = 0;
            $giftProducts = 0;

            $items = $this->_cart->getQuote()->getAllItems();
            foreach ($items as $item) {

                if ($item->getProduct()->getId() == $freeProductId) {
                    $giftProducts += $item->getQty();
                } elseif ($item->getAppliedRuleIds() && in_array($rule->getId(), explode(',', $item->getAppliedRuleIds()))) {
                    $normalProducts += $item->getQty();
                }
            }
            
            if($normalProducts<$giftProducts){
                return $discountData;
            }

            if ($item->getProduct()->getId() != $freeProductId) {

                $params = array(
                    'product' => $freeProductId,
                    'qty' => 1
                );

                $product = $this->_productRepository->getById($freeProductId);

                if ($product->getId()) {
                    $this->_cart->addProduct($product, $params);
                }
                
            } else {

                $item->setCustomPrice(0);
                $item->setOriginalCustomPrice(0);
                $item->getProduct()->setIsSuperMode(true);
            }

        }

        return $discountData;
    }

}
