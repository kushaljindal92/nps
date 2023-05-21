<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Api\Data;

interface NpsInterface
{

    const ORDER_ID = 'order_id';
    const CUSTOMER_ID = 'customer_id';
    const NPS_ID = 'nps_id';
    const UPDATED_AT = 'updated_at';
    const NPS_EMAIL_STATUS = 'nps_email_status';
    const COUPON = 'coupon';
    const CREATED_AT = 'created_at';
    const NPS_SCORE = 'nps_score';

    /**
     * Get nps_id
     * @return string|null
     */
    public function getNpsId();

    /**
     * Set nps_id
     * @param string $npsId
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setNpsId($npsId);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setOrderId($orderId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setCustomerId($customerId);

    /**
     * Get nps_email_status
     * @return string|null
     */
    public function getNpsEmailStatus();

    /**
     * Set nps_email_status
     * @param string $npsEmailStatus
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setNpsEmailStatus($npsEmailStatus);

    /**
     * Get nps_score
     * @return string|null
     */
    public function getNpsScore();

    /**
     * Set nps_score
     * @param string $npsScore
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setNpsScore($npsScore);

    /**
     * Get coupon
     * @return string|null
     */
    public function getCoupon();

    /**
     * Set coupon
     * @param string $coupon
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setCoupon($coupon);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Magentomaster\Nps\Nps\Api\Data\NpsInterface
     */
    public function setUpdatedAt($updatedAt);
}

