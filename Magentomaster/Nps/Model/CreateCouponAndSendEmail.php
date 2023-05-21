<?php

namespace Magentomaster\Nps\Model;

use Magento\SalesRule\Api\CouponRepositoryInterface;
use Magento\SalesRule\Api\Data\CouponInterfaceFactory;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Customer\Model\CustomerFactory;

class CreateCouponAndSendEmail
{
    protected $couponRepository;
    protected $couponFactory;
    protected $ruleFactory;

    public const COUPON_EMAIL = 'coupon_email';

    public function __construct(
        CouponRepositoryInterface $couponRepository,
        CouponInterfaceFactory $couponFactory,
        ScopeConfigInterface $scopeConfigInterface,
        TransportBuilder $transportBuilder,
        RuleFactory $ruleFactory,
        CustomerFactory $customerFactory
    ) {
        $this->couponRepository = $couponRepository;
        $this->couponFactory = $couponFactory;
        $this->ruleFactory = $ruleFactory;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfigInterface = $scopeConfigInterface;
        $this->customer = $customerFactory;
    }

    public function generateCouponForCustomer($customerId)
    {
        if(empty($customerId)){
            return;
        }
        // Generate a unique coupon code
        $couponCode = 'NPS-5-DISCOUNT'.time();

        //create rule
        $ruleid = $this->generateCouponRule();
        $coupon = $this->couponFactory->create();
        $coupon->setRuleId($ruleid);
        $coupon->setCode($couponCode);
        $coupon->setUsageLimit(1); // Specify the usage limit for each coupon if needed
        $coupon->setIsPrimary(NULL);
        $coupon->setType(1);
        $coupon->setUsagePerCustomer(1);
        $coupon->setCustomerId($customerId);
        $coupon->save();
        //end rule 

        //send email to customer
        $customer = $this->customer->create()->load($customerId);

        $templateVars = [
            'customer_name'=> $customer->getName(),
            'coupon_code' => $couponCode
        ];
        $this->sendEmail(SELF::COUPON_EMAIL,$templateVars,$customer->getEmail());
        //end code here
    }

    /**
     * send coupon function
     *
     * @return void
     */
    /**
     * Send email function
     *
     * @param  $order
     * @return void
     */
    public function sendEmail($identifier,$templateVars,$customerEmail)
    {
        $sender_email = $this->scopeConfigInterface->getValue('nps/nps/nps_email_id', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $email_from = $this->scopeConfigInterface->getValue('nps/nps/nps_email_from', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        
        if(!$sender_email){
            return;
        }

        $this->transportBuilder->setTemplateIdentifier($identifier)
            ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_ADMINHTML, 'store' => 1])
            ->setTemplateVars($templateVars)
            ->setFrom(['name' => $email_from, 'email' => $sender_email])
            ->addTo([$customerEmail])
            ->getTransport()
            ->sendMessage();
    }

    public function generateCouponRule()
    {
        // Create a rule and associate the coupon
        $rule = $this->ruleFactory->create();
        $collection = $rule->getCollection()->addFieldToFilter('name','5% off');

        if($collection->getSize() == 0){
            $rule->setName('5% off')
            ->setDescription('5% off')
            ->setUsesPerCustomer(0)
            ->setCustomerGroupIds(array('1','2','3'))
            ->setIsActive(1)
            ->setSimpleAction('by_percent')
            ->setDiscountAmount(5)
            ->setDiscountQty(1)
            ->setApplyToShipping(0)
            ->setTimesUsed(1000)
            ->setWebsiteIds(array('1'))
            ->setCouponType(3)
            ->setUsesPerCoupon(NULL);
            $rule->save();
        }else{
            foreach($collection as $rule){
                return $rule->getId();
            }
        }
        return $rule->getId();
    }
}