<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Observer\Sales;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magentomaster\Nps\Model\ResourceModel\Nps\CollectionFactory;
use Magentomaster\Nps\Model\Nps;
use Magentomaster\Nps\Model\CreateCouponAndSendEmail;
use Magento\Framework\Encryption\EncryptorInterface;

class OrderSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    const NPS_EMAIL_IDENTIFIER = 'nps_email';
    const NPS_EMAIL_SUBJECT = 'NPS Email';

    private $encryptor;
    protected $nps;
    protected $npsCollection;

    public function __construct(
        StoreManagerInterface $storeManager, 
        ScopeConfigInterface $scopeConfigInterface,
        CollectionFactory $npsCollection,
        Nps $nps,
        EncryptorInterface $encryptor,
        CreateCouponAndSendEmail $createCouponAndSendEmail
    ){
        $this->storeManager = $storeManager;
        $this->scopeConfigInterface = $scopeConfigInterface;
        $this->nps = $nps;
        $this->npsCollection = $npsCollection;
        $this->encryptor = $encryptor;
        $this->emailHelper = $createCouponAndSendEmail;
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
        $enableEmail = $this->scopeConfigInterface->getValue('nps/nps/send_email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $order = $observer->getEvent()->getOrder();
       /*  if(!$enableEmail || $order->getState() !== \Magento\Sales\Model\Order::STATE_COMPLETE){
            return;
        } */
        
        $collection = $this->npsCollection->create()->addFieldToFilter('order_id',$order->getId());
        if($collection->getSize() > 0){
            return;
        }
        
        $nps = $this->nps;
        $nps->setOrderId($order->getId());
        $nps->setCustomerId($order->getCustomerId());
        $nps->setNpsEmailStatus(1);
        try{
            $nps->save();
        }catch(Exception $e){
            //log error here
        }

        //send email
        $npsLink = $this->encryptNpsLink($nps->getId());
        $templateVars = [
            'order' => $order,
            'store' => $this->storeManager->getStore(1),
            'nps_link' => $npsLink,
            'customer_name' => $order->getCustomerName()
        ];
        $this->emailHelper->sendEmail(SELF::NPS_EMAIL_IDENTIFIER,$templateVars,$order->getCustomerEmail());
        //end here
    }

    protected function encryptNpsLink($nps_id){
        $url = $this->storeManager->getStore()->getBaseUrl();
        $encryptedData = $nps_id;//$this->encryptor->encrypt((int)$nps_id);
        return $url.'magentomaster?data='.$encryptedData;
    }
}

