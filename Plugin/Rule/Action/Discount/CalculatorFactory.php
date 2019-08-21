<?php

/**
 * Free product salesrule
 *
 * @category   LCB
 * @package    LCB_FreeProduct
 * @author     Silpion Tomasz Gregorczyk <tom@lcbrq.com>
 */

namespace LCB\FreeProduct\Plugin\Rule\Action\Discount;

class CalculatorFactory {

    protected $classByType = [
        \LCB\FreeProduct\Model\Rule::FREE_PRODUCT_ACTION => 'LCB\FreeProduct\Model\Rule\Action\Gift\Product'
    ];

    /**
     * @param \Magento\SalesRule\Model\Rule\Action\Discount\CalculatorFactory\Interceptor $subject
     * @param \Closure $proceed
     * @param string $type
     * @return \Magento\SalesRule\Model\Rule\Action\Discount\DiscountInterface
     * @throws \InvalidArgumentException
     */
    public function aroundCreate(
        \Magento\SalesRule\Model\Rule\Action\Discount\CalculatorFactory\Interceptor $subject, 
        \Closure $proceed, 
        $type
    )
    {

        if ($type == \LCB\FreeProduct\Model\Rule::FREE_PRODUCT_ACTION) {
            return \Magento\Framework\App\ObjectManager::getInstance()->create($this->classByType[$type]);
        }

        return $proceed($type);
    }

}
