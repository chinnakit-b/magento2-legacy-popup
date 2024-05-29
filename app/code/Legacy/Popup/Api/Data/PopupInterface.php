<?php

namespace Legacy\Popup\Api\Data;
interface PopupInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const STORE_IDS = 'store_ids';
    const CUSTOMER_GROUP_IDS = 'customer_group_ids';
    const CONTENT = 'content';
    const WIDTH = 'width';
    const HEIGHT = 'height';
    const CUSTOM_STYLE = 'custom_style';
    const CLOSE_BTN_COLOR = 'close_btn_color';
    const DONT_SHOW_BTN_COLOR = 'dont_show_btn_color';
    const WHICH_PAGE_TO_SHOW = 'which_page_to_show';
    const INCLUDE_PAGES = 'include_pages';
    const EXCLUDE_PAGE = 'exclude_page';
    const PUBLISH_DATE = 'publish_date';
    const PUBLISH_DATE_END = 'publish_date_end';
    const IS_ACTIVE = 'is_active';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const SORT_ORDER = 'sort_order';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set EntityId.
     */
    public function setEntityId($entityId);

    /**
     * Get Name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set Name.
     */
    public function setName($name);

    /**
     * Get Description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set Description.
     */
    public function setDescription($description);

    /**
     * Get Store Ids.
     *
     * @return string
     */
    public function getStoreIds();

    /**
     * Set Store Ids.
     */
    public function setStoreIds($storeids);

    /**
     * Get Customer Group Ids
     *
     * @return string
     */
    public function getCustomerGroupIds();

    /**
     * Set Customer Group Ids
     */
    public function setCustomerGroupIds($customergroupids);

    /**
     * Get Content.
     *
     * @return string
     */
    public function getContent();

    /**
     * Set Content.
     */
    public function setContent($content);

    /**
     * Get Width.
     *
     * @return string
     */
    public function getWidth();

    /**
     * Set Width.
     */
    public function setWidth($width);

    /**
     * Get Height.
     *
     * @return string
     */
    public function getHeight();

    /**
     * Set Height.
     */
    public function setHeight($height);

    /**
     * Get CustomStyle.
     *
     * @return string
     */
    public function getCustomStyle();

    /**
     * Set CustomStyle.
     */
    public function setCustomStyle($customstyle);

    /**
     * Get CloseBtnColor.
     *
     * @return string
     */
    public function getCloseBtnColor();

    /**
     * Set CloseBtnColor.
     */
    public function setCloseBtnColor($close_btn_color);

    /**
     * Get DontShowBtnColor.
     *
     * @return string
     */
    public function getDontShowBtnColor();

    /**
     * Set DontShowBtnColor.
     */
    public function setDontShowBtnColor($dont_show_btn_color);

    /**
     * Get which_page_to_show.
     *
     * @return string
     */
    public function getWhichPageToShow();

    /**
     * Set which_page_to_show.
     */
    public function setWhichPageToShow($which_page_to_show);

    /**
     * Get include_pages.
     *
     * @return string
     */
    public function getIncludePages();

    /**
     * Set include_pages.
     */
    public function setIncludePages($include_pages);

    /**
     * Get exclude_page.
     *
     * @return string
     */
    public function getExcludePage();

    /**
     * Set exclude_page.
     */
    public function setExcludePage($exclude_page);

    /**
     * Get Publish Date.
     *
     * @return string
     */
    public function getPublishDate();

    /**
     * Set PublishDate.
     */
    public function setPublishDate($publishDate);


    /**
     * Get Publish Date.
     *
     * @return string
     */
    public function getPublishDateEnd();

    /**
     * Set Publish Date End.
     */
    public function setPublishDateEnd($publishDateEnd);

    /**
     * Get IsActive.
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Set IsActive.
     */
    public function setIsActive($isActive);

    /**
     * Get CreatedAt.
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt);

    /**
     * Get UpdatedAt.
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set CreatedAt.
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get Sort Order.
     *
     * @return int
     */
    public function getSortOrder();

    /**
     * Set Sort Order.
     */
    public function setSortOrder($sortOrder);
}
