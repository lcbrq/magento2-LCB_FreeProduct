<?php

/**
 * Free product salesrule
 *
 * @category   LCB
 * @package    LCB_FreeProduct
 * @author     Silpion Tomasz Gregorczyk <tom@lcbrq.com>
 */

namespace LCB\FreeProduct\Model;

class Rule extends \Magento\Rule\Model\AbstractModel {

    /**
     * Rule type actions
     */
    const FREE_PRODUCT_ACTION = 'free_product';

    /*
     * Get rule condition combine model instance
     *
     * @return \Magento\SalesRule\Model\Rule\Condition\Combine
     */

    public function getConditionsInstance()
    {
        return $this->_condCombineFactory->create();
    }

    /**
     * Get rule condition product combine model instance
     *
     * @return \Magento\SalesRule\Model\Rule\Condition\Product\Combine
     */
    public function getActionsInstance()
    {
        return $this->_condProdCombineF->create();
    }

}
