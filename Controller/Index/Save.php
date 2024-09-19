<?php
namespace Maverick\CustomerForm\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Maverick\CustomerForm\Model\CustomerData;
use Magento\Framework\App\RequestInterface;

class Save extends Action
{
    protected $customerData;

    public function __construct(Context $context, CustomerData $customerData)
    {
        $this->customerData = $customerData;
        parent::__construct($context);
    }

    public function execute()
    {
        $postData = $this->getRequest()->getPostValue();

        if ($postData) {
            try {
                $this->customerData->saveData($postData['name'], $postData['email']);
                $this->messageManager->addSuccessMessage(__('Data saved successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error saving data.'));
            }
        }

        $this->_redirect('*/*/index');
    }
}
