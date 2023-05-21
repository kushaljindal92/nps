<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface NpsRepositoryInterface
{

    /**
     * Save Nps
     * @param \Magentomaster\Nps\Api\Data\NpsInterface $nps
     * @return \Magentomaster\Nps\Api\Data\NpsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Magentomaster\Nps\Api\Data\NpsInterface $nps
    );

    /**
     * Retrieve Nps
     * @param string $npsId
     * @return \Magentomaster\Nps\Api\Data\NpsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($npsId);

    /**
     * Retrieve Nps matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magentomaster\Nps\Api\Data\NpsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Nps
     * @param \Magentomaster\Nps\Api\Data\NpsInterface $nps
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Magentomaster\Nps\Api\Data\NpsInterface $nps
    );

    /**
     * Delete Nps by ID
     * @param string $npsId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($npsId);
}

