<?php

namespace Legacy\Popup\Model;

use Legacy\Popup\Api\Data\PopupInterface;

class Popup extends \Magento\Framework\Model\AbstractModel implements PopupInterface
{

    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'legacy_popup';

    /**
     * @var string
     */
    protected $_cacheTag = 'legacy_popup';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'legacy_popup';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Legacy\Popup\Model\ResourceModel\Popup');
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    public function getStoreIds()
    {
        return $this->getData(self::STORE_IDS);
    }

    public function setStoreIds($storeids)
    {
        return $this->setData(self::STORE_IDS, $storeids);
    }

    public function getCustomerGroupIds()
    {
        return $this->getData(self::CUSTOMER_GROUP_IDS);
    }

    public function setCustomerGroupIds($customergroupids)
    {
        return $this->setData(self::CUSTOMER_GROUP_IDS, $customergroupids);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    public function getWidth()
    {
        return $this->getData(self::WIDTH);
    }

    public function setWidth($width)
    {
        return $this->setData(self::CONTENT, $width);
    }

    public function getHeight()
    {
        return $this->getData(self::HEIGHT);
    }

    public function setHeight($height)
    {
        return $this->setData(self::CONTENT, $height);
    }

    public function getCustomStyle()
    {
        return $this->getData(self::CUSTOM_STYLE);
    }

    public function setCustomStyle($customstyle)
    {
        return $this->setData(self::CONTENT, $customstyle);
    }


    public function getCloseBtnColor()
    {
        return $this->getData(self::CLOSE_BTN_COLOR);
    }

    public function setCloseBtnColor($close_btn_color)
    {
        return $this->setData(self::CLOSE_BTN_COLOR, $close_btn_color);
    }

    public function getDontShowBtnColor()
    {
        return $this->getData(self::DONT_SHOW_BTN_COLOR);
    }

    public function setDontShowBtnColor($dont_show_btn_color)
    {
        return $this->setData(self::DONT_SHOW_BTN_COLOR, $dont_show_btn_color);

    }

    public function getWhichPageToShow()
    {
        return $this->getData(self::WHICH_PAGE_TO_SHOW);
    }

    public function setWhichPageToShow($which_page_to_show)
    {
        return $this->setData(self::WHICH_PAGE_TO_SHOW, $which_page_to_show);
    }

    public function getIncludePages()
    {
        return $this->getData(self::INCLUDE_PAGES);
    }

    public function setIncludePages($include_pages)
    {
        return $this->setData(self::INCLUDE_PAGES, $include_pages);
    }

    public function getExcludePage()
    {
        return $this->getData(self::EXCLUDE_PAGE);
    }

    public function setExcludePage($exclude_page)
    {
        return $this->setData(self::EXCLUDE_PAGE, $exclude_page);
    }

    public function getPublishDate()
    {
        return $this->getData(self::PUBLISH_DATE);
    }

    public function setPublishDate($publishDate)
    {
        return $this->setData(self::PUBLISH_DATE, $publishDate);
    }

    public function getPublishDateEnd()
    {
        return $this->getData(self::PUBLISH_DATE_END);
    }

    public function setPublishDateEnd($publishDateEnd)
    {
        return $this->setData(self::PUBLISH_DATE_END, $publishDateEnd);
    }

    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    public function getSortOrder()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::UPDATED_AT, $sortOrder);
    }

}
