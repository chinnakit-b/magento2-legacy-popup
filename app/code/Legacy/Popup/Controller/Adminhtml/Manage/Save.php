<?php

namespace Legacy\Popup\Controller\Adminhtml\Manage;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Legacy\Popup\Model\PopupFactory
     */
    var $popupFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Legacy\Popup\Model\PopupFactory $popupFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Legacy\Popup\Model\PopupFactory $popupFactory
    ) {
        parent::__construct($context);
        $this->popupFactory = $popupFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('legacy_popup/manage/manage');
            return;
        }
        try {
            $rowData = $this->popupFactory->create();
//            \Magento\Framework\App\ObjectManager::getInstance()->get('Psr\Log\LoggerInterface')->info(json_encode($data));
            if (isset($data['store_ids'])){
                $data['store_ids'] = implode(", ",  $data['store_ids']);
            }

            if (isset($data['customer_group_ids'])){
                $data['customer_group_ids'] = implode(", ",  $data['customer_group_ids']);
            }

            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('legacy_popup/manage/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Legacy_Popup::save_popup');
    }
}
