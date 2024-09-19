<?php
namespace Maverick\CustomerForm\Model;

use Magento\Framework\Model\AbstractModel;

class CustomerData
{
    protected $resource;
    protected $connection;

    public function __construct(\Magento\Framework\App\ResourceConnection $resource)
    {
        $this->resource = $resource;
        $this->connection = $this->resource->getConnection();
    }

    public function saveData($name, $email)
    {
        $tableName = $this->resource->getTableName('customer_form_data');

        $this->connection->insert($tableName, [
            'name' => $name,
            'email' => $email,
        ]);
    }
}
