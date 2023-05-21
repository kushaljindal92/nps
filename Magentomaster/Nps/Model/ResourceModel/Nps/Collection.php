<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Model\ResourceModel\Nps;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'nps_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Magentomaster\Nps\Model\Nps::class,
            \Magentomaster\Nps\Model\ResourceModel\Nps::class
        );
    }
}

