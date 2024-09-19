<?php
namespace Maverick\CustomerForm\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getFormAction()
    {
        return $this->getUrl('customerform/index/save');
    }
}
