<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Model;

use Magento\Framework\Model\AbstractModel;
use Magentomaster\Nps\Api\Data\NpsInterface;

class Nps extends AbstractModel implements NpsInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Magentomaster\Nps\Model\ResourceModel\Nps::class);
    }

    /**
     * @inheritDoc
     */
    public function getNpsId()
    {
        return $this->getData(self::NPS_ID);
    }

    /**
     * @inheritDoc
     */
    public function setNpsId($npsId)
    {
        return $this->setData(self::NPS_ID, $npsId);
    }

    /**
     * @inheritDoc
     */
    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * @inheritDoc
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheritDoc
     */
    public function getNpsEmailStatus()
    {
        return $this->getData(self::NPS_EMAIL_STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setNpsEmailStatus($npsEmailStatus)
    {
        return $this->setData(self::NPS_EMAIL_STATUS, $npsEmailStatus);
    }

    /**
     * @inheritDoc
     */
    public function getNpsScore()
    {
        return $this->getData(self::NPS_SCORE);
    }

    /**
     * @inheritDoc
     */
    public function setNpsScore($npsScore)
    {
        return $this->setData(self::NPS_SCORE, $npsScore);
    }

    /**
     * @inheritDoc
     */
    public function getCoupon()
    {
        return $this->getData(self::COUPON);
    }

    /**
     * @inheritDoc
     */
    public function setCoupon($coupon)
    {
        return $this->setData(self::COUPON, $coupon);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}

