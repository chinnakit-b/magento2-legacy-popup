<?php

namespace Legacy\Popup\Model\ResourceModel\Popup;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Legacy\Popup\Model\Popup',
            'Legacy\Popup\Model\ResourceModel\Popup'
        );
    }
}
