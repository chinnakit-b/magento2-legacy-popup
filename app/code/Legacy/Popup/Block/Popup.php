<?php

namespace Legacy\Popup\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Request\Http;
/**
 * @method string getPosition()
 */
class Popup extends Template
{
    protected $helperData;

    protected $_popupCollectionFactory;

    protected $dateTime;

    protected $_storeManager;

    protected $request;

    public function __construct(
        Template\Context $context,
        \Legacy\Popup\Helper\Data $helperData,
        \Legacy\Popup\Model\ResourceModel\Popup\CollectionFactory $popupCollectionFactory,
        DateTime $dateTime,
        StoreManagerInterface $storeManager,
        Http $request,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->helperData = $helperData;
        $this->_popupCollectionFactory = $popupCollectionFactory;
        $this->dateTime = $dateTime;
        $this->_storeManager = $storeManager;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function isEnable()
    {
        return $this->helperData->getGeneralConfig('enable');
    }

    public function cookieExpire()
    {
        return $this->helperData->getGeneralConfig('cookie_exp');
    }

    public function dontShowBtn()
    {
        return $this->helperData->getGeneralConfig('dont_show_btn');
    }

    public function getAllPopup(){
        $popup_collection = $this->_popupCollectionFactory->create();
        $currentDate = $this->dateTime->date();
        $popup_collection->addFieldToFilter('is_active', ['eq' => 1]);

//        $popup_collection->addFieldToFilter(
//                ['publish_date', 'publish_date_end'],
//                [
//                    ['lteq' => $currentDate],
//                    ['gteq' => $currentDate]
//                ]
//            )
//            ->addFieldToFilter(
//                ['publish_date', 'publish_date_end'],
//                [
//                    ['lteq' => $currentDate],
//                    ['null' => true]
//                ]
//            )
//            ->addFieldToFilter(
//                ['publish_date', 'publish_date_end'],
//                [
//                    ['null' => true],
//                    ['gteq' => $currentDate]
//                ]
//            )
//            ->addFieldToFilter(
//                ['publish_date', 'publish_date_end'],
//                [
//                    ['null' => true],
//                    ['null' => true]
//                ]
//            );

        $customWhere = "(publish_date <= '$currentDate' AND publish_date_end >= '$currentDate') OR
                        (publish_date <= '$currentDate' AND publish_date_end IS NULL) OR
                        (publish_date IS NULL AND publish_date_end >= '$currentDate') OR
                        (publish_date IS NULL AND publish_date_end IS NULL)";

        // Apply custom WHERE condition
        $popup_collection->getSelect()->where($customWhere);

        $popup_collection->addOrder('sort_order', 'ASC');
        $popup_collection->addOrder('created_at', 'ASC');
// Ensure the collection is loaded
//        $popup_collection->load();
//        echo $popup_collection->getSelect()->__toString();

        return $popup_collection->getData();
    }

    public function replaceMediaPath($html){
        $html = stripslashes($html);
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        $html = str_replace('{{media url=&quot;', $mediaUrl, $html);
        $html = str_replace('{{media url="', $mediaUrl, $html);

        $html = str_replace('"}}', '', $html);
        $html = str_replace('&quot;}}', '', $html);

        return $html;
    }

    public function currentFullActionName()
    {
        return $this->request->getFullActionName();
    }

    public function setIncludeExcludePage($all_popup)
    {
        $full_ac_name = $this->currentFullActionName();
        foreach ($all_popup as $idx => $value){
            if ($value['which_page_to_show'] == 2){
                if (!empty($value['include_pages'])){
                    $ic = explode("\n", $value['include_pages']);
                    if (!in_array($full_ac_name, $ic)){
                        unset($all_popup[$idx]);
                    }
                }

                if (!empty($value['exclude_page'])){
                    $ec = explode("\n", $value['exclude_page']);
                    if (in_array($full_ac_name, $ec)){
                        unset($all_popup[$idx]);
                    }
                }
            }
        }

        return $all_popup;
    }

    public function renderCustomStyleCss($popup){
        $style = '';
        if (!empty($popup['custom_style'])){
            $id_before = '#unique_popup_id_'.$popup['entity_id']. " ";
            $cssString = $popup['custom_style'];
            $modifiedCss = preg_replace('/(^|})([^{}]+)/', "$1$id_before $2", $cssString);
            $style = '<style>'.$modifiedCss.'</style>';
        }

        return $style;
    }
}
