<?php

namespace Legacy\Popup\Block\Adminhtml\Manage\Edit;

use Magento\Backend\Block\Store\Switcher\Form\Renderer\Fieldset\Element as StoreSwitcher;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as GroupCollectionFactory;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    protected $groupCollectionFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Legacy\Popup\Model\Status $options,
        \Magento\Store\Model\System\Store $systemStore,
        GroupCollectionFactory $groupCollectionFactory,
        array $data = []
    )
    {
        $this->_options = $options;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        $this->groupCollectionFactory = $groupCollectionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('popup_data');
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('lgpopup_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Popup'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Popup'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'id' => 'name',
                'title' => __('Name'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Description'),
                'id' => 'description',
                'title' => __('Description'),
                'required' => false,
            ]
        );

        // Add store views to fieldset
        $fieldset->addField(
            'store_ids',
            'multiselect',
            [
                'name' => 'store_ids[]',
                'label' => __('Store Views'),
                'title' => __('Store Views'),
                'required' => true,
                'values' => $this->_systemStore->getStoreValuesForForm(false, true), // Retrieve store views
                'renderer' => $this->getLayout()->createBlock(StoreSwitcher::class)->setTemplate('Magento_Store::system/store/switcher.phtml') // Add store switcher renderer
            ]
        );

        // Add customer groups field
        $fieldset->addField(
            'customer_group_ids',
            'multiselect',
            [
                'name' => 'customer_group_ids[]',
                'label' => __('Customer Groups'),
                'title' => __('Customer Groups'),
                'required' => true,
                'values' => $this->getCustomerGroups(),
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'label' => __('Content'),
                'style' => 'height:25em;',
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'custom_style',
            'textarea',
            [
                'name' => 'custom_style',
                'label' => __('Custom Style CSS'),
                'style' => 'height:15em;',
                'required' => false,
                'config' => $wysiwygConfig
            ]
        );

        $fieldset->addField(
            'close_btn_color',
            'text',
            [
                'name' => 'close_btn_color',
                'label' => __("Close Popup Button Color"),
                'id' => 'close_btn_color',
                'title' => __("DClose Popup Button Color"),
                'style' => 'width:113px',
                'class' => 'color-input',
                'required' => false,
            ]
        );

        $fieldset->addField(
            'dont_show_btn_color',
            'text',
            [
                'name' => 'dont_show_btn',
                'label' => __("Don't show this Popup again Button Color"),
                'id' => 'dont_show_btn',
                'title' => __("Don't show this Popup again Button Color"),
                'style' => 'width:113px',
                'class' => 'color-input',
                'required' => false,
            ]
        );

        $fieldset->addField(
            'width',
            'text',
            [
                'name' => 'width',
                'label' => __('Width'),
                'id' => 'width',
                'title' => __('Width'),
                'style' => 'width:113px',
                'required' => false,
            ]
        )->setAfterElementHtml('<div>If empty default value is min width 450px</div>');

        $fieldset->addField(
            'height',
            'text',
            [
                'name' => 'height',
                'label' => __('Height'),
                'id' => 'height',
                'title' => __('Height'),
                'style' => 'width:113px',
                'required' => false,
            ]
        )->setAfterElementHtml('<div>If empty default value is height auto</div>');

        $Responsive = $fieldset->addField(
            'responsive',
            'select',
            [
                'name' => 'responsive',
                'label' => __('Responsive'),
                'title' => __('Responsive'),
                'required' => false,
                'options' => ['1' => __('No'),
                    '2' => __('Yes'),
                ]
            ]
        );

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /* Create a new product object */
        $layout = $objectManager->create("Magento\Framework\View\Element\Template");
        $html = $layout->setTemplate("Legacy_Popup::field/options.phtml")->toHtml();
        $ResponsiveOption = $fieldset->addField(
            'responsive_option',
            'text',
            [
                'name' => 'responsive_option',
                'label' => __(''),
                'title' => __(''),
                'style' => 'display: none;',
                'required' => false,
            ]
        )->setAfterElementHtml($html);


        $which_page_to_show = $fieldset->addField(
            'which_page_to_show',
            'select',
            [
                'name' => 'which_page_to_show',
                'label' => __('Page(s) to show'),
                'title' => __('Page(s) to show'),
                'required' => false,
                'options' => [
                    '1' => __('All Pages'),
                    '2' => __('Specific pages'),
                ],
                'value' => 1
            ]
        );

        $i_page = $fieldset->addField(
            'include_pages',
            'textarea',
            [
                'name' => 'include_pages',
                'label' => __('Include page(s)'),
                'id' => 'include_pages',
                'title' => __('Include page(s)'),
                'required' => false,
                'style' => 'width: 60rem; min-height: 10rem;',
            ]
        )->setAfterElementHtml('<br><span>Example: <b>cms_index_index</b> (for homepage)</span><br /> <span>Separated by a new line</span>');

        $e_page = $fieldset->addField(
            'exclude_page',
            'textarea',
            [
                'name' => 'exclude_page',
                'label' => __('Exclude page(s)'),
                'id' => 'exclude_page',
                'title' => __('Exclude page(s)'),
                'required' => false,
                'placeholder' => __('Your Placeholder Text Here'),
                'style' => 'width: 60rem; min-height: 10rem;',
            ]
        )->setAfterElementHtml('<br><span>Example: <b>cms_index_index</b> (for homepage)</span><br /> <span>Separated by a new line</span>');

        $fieldset->addField(
            'publish_date',
            'date',
            [
                'name' => 'publish_date',
                'label' => __('Publish Date'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'class' => 'required-entry',
                'style' => 'width:200px',
            ]
        );

        $fieldset->addField(
            'publish_date_end',
            'date',
            [
                'name' => 'publish_date_end',
                'label' => __('Publish Date End'),
                'date_format' => $dateFormat,
                'time_format' => 'HH:mm:ss',
                'class' => 'validate-date validate-date-range date-range-custom_theme-from',
                'style' => 'width:200px',
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Status'),
                'id' => 'is_active',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'sort_order',
            'text',
            [
                'name' => 'sort_order',
                'label' => __('Sort'),
                'id' => 'sort_order',
                'title' => __('Sort'),
                'class' => 'required-entry',
                'pattern' => '[0-9]*',
                'required' => true,
                'style' => 'width:113px',
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        $this->setChild(
            'form_after',
            $this->getLayout()->createBlock('\Magento\Backend\Block\Widget\Form\Element\Dependence')
                ->addFieldMap($Responsive->getHtmlId(), $Responsive->getName())
                ->addFieldMap($ResponsiveOption->getHtmlId(), $ResponsiveOption->getName())
                ->addFieldDependence($ResponsiveOption->getName(), $Responsive->getName(), 2)

                ->addFieldMap($which_page_to_show->getHtmlId(), $which_page_to_show->getName())
                ->addFieldMap($i_page->getHtmlId(), $i_page->getName())
                ->addFieldMap($e_page->getHtmlId(), $e_page->getName())
                ->addFieldDependence($i_page->getName(), $which_page_to_show->getName(), 2)
                ->addFieldDependence($e_page->getName(), $which_page_to_show->getName(), 2)
        );

//        $this->setChild(
//            'form_after',
//            $this->getLayout()->createBlock('\Magento\Backend\Block\Widget\Form\Element\Dependence')
//
//        );

        return parent::_prepareForm();
    }

    protected function getCustomerGroups()
    {
        $options = [];
        $collection = $this->groupCollectionFactory->create();
        foreach ($collection as $group) {
            $options[] = [
                'value' => $group->getId(),
                'label' => $group->getCustomerGroupCode()
            ];
        }
        return $options;
    }
}


