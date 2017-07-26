<?php

/**
 * Free product salesrule
 *
 * @category   LCB
 * @package    LCB_FreeProduct
 * @author     Silpion Tomasz Gregorczyk <tom@lcbrq.com>
 */

namespace LCB\FreeProduct\Plugin\Rule\Metadata;

class ValueProvider {
    
    /**
     * Get metadata for sales rule form. It will be merged with form UI component declaration.
     *
     * @param \Magento\SalesRule\Model\Rule\Metadata\ValueProvider\Interceptor $provider
     * @param array $result
     * @return array
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */

    public function afterGetMetadataValues(
        \Magento\SalesRule\Model\Rule\Metadata\ValueProvider\Interceptor $provider, 
        $result
        )
    {
        $result['actions']['children']['simple_action']['arguments']['data']['config']['options'][] = array(
            'label' => __('Buy X get Y as gift (discount amount is Y id)'),
            'value' => 'free_product'
        );

        return $result;
    }

}
