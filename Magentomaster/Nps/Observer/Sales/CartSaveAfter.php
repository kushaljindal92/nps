<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Observer\Sales;
use Magentomaster\Nps\Model\NpsFactory;

class CartSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * Construct function
     *
     * @param NpsFactory $nps
     */
    public function __construct(protected NpsFactory $nps){
    }
    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        $quote = $observer->getEvent()->getQuote();
        $customerId = $quote->getCustomerId();
        if(!empty($quote->getCouponCode())){
            $couponData = $this->nps->create()->getCollection()->addFieldToFilter('coupon',$quote->getCouponCode())->getFirstItem();
            if(!empty($couponData) && $couponData->getCustomerId() != $customerId){
                $quote->setCouponCode('')->collectTotals();
            }
        }   
    }
}

