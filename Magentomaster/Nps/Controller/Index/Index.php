<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magentomaster\Nps\Model\Nps;
use Magentomaster\Nps\Model\CreateCouponAndSendEmail;
use Magento\Framework\Encryption\EncryptorInterface;

class Index implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var $request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\Http $request,
        Nps $nps,
        CreateCouponAndSendEmail $createCupon,
        EncryptorInterface $encryptedData
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->request = $request;
        $this->nps = $nps;
        $this->encryptedData = $encryptedData;
        $this->createCoupon = $createCupon;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        //echo $this->request->getParam('data'); die;
        //$encrypdatedData = $this->request->getParam('data');
        //$data = $this->encryptedData->decrypt('0:3:RmovxRV4ucSV VnqWzP0xBBwX2qR9EBJeXZWDnA');
        //echo $this->request->getParam('score'); die;
        $nps = $this->nps->load($this->request->getParam('data'));
        //if(empty($nps->getNpsScore())){
            $coupon = $this->createCoupon->generateCouponForCustomer($nps->getCustomerId());
            $nps->setCoupon($coupon);
            $nps->setNpsScore($this->request->getParam('score'));
            try{
                $nps->save();
                
            }catch(Exception $e){
                //log data
            }
        //}

        //echo "<pre>"; print_r($data); die('ddd');
        return $this->resultPageFactory->create();
    }
}

