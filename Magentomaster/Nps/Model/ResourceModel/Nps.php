<?php
/**
 * Copyright © kushal kumar All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magentomaster\Nps\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Nps extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('magentomaster_nps_nps', 'nps_id');
    }
}

