<?php

namespace Legacy\Popup\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class Manage extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Legacy\Popup\Model\PopupFactory
     */
    private $popupFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Legacy\Popup\Model\PopupFactory $popupFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Legacy\Popup\Model\PopupFactory $popupFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->popupFactory = $popupFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $id = (int) $this->getRequest()->getParam('id');
        $rowData = $this->popupFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($id) {
            $rowData = $rowData->load($id);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getEntityId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('legacy_popup/manage/index');
                return;
            }
        }

        $this->coreRegistry->register('popup_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $id ? __('Edit Pop').$rowTitle : __('Add Popup 1');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Legacy_Popup::add_popup');
    }
}
