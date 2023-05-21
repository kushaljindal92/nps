<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Api\Data;

interface NpsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Nps list.
     * @return \Magentomaster\Nps\Api\Data\NpsInterface[]
     */
    public function getItems();

    /**
     * Set order_id list.
     * @param \Magentomaster\Nps\Api\Data\NpsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

