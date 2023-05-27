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
        $encrypdatedData = $this->request->getParam('data');
        if(!empty($encrypdatedData)){
            $encrypdatedData = str_replace(" ", "+", $encrypdatedData);
            $data = $this->encryptedData->decrypt($encrypdatedData);
        }
        if(!empty($this->request->getParam('score')) && $this->request->getParam('score') <= 10 && $this->request->getParam('score') >= 0){
            $score = $this->request->getParam('score');
        }
        
        //check if id exist, it may throw error if id does not exist
        $nps = $this->nps->load($data);

        if(empty($nps->getNpsScore())){
            $coupon = $this->createCoupon->generateCouponForCustomer($nps->getCustomerId());
            $nps->setCoupon($coupon);
            $nps->setNpsScore($score);
            try{
                $nps->save();
            }catch(Exception $e){
                //log data
            }
        }
        return $this->resultPageFactory->create();
    }
}

