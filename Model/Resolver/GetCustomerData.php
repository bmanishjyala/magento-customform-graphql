<?php
namespace Maverick\CustomerForm\Model\Resolver;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

class GetCustomerData implements ResolverInterface
{
    protected $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $connection = $this->resource->getConnection();
        $tableName = $this->resource->getTableName('customer_form_data');

        // Prepare the select query
        $select = $connection->select()->from($tableName, ['id', 'name', 'email']);

        // Check if the 'name' argument is provided, apply the filter if so
        if (isset($args['name'])) {
            $name = $args['name'];
            if (empty($name)) {
                throw new GraphQlInputException(__('Name cannot be empty.'));
            }
            $select->where('name = ?', $name);
        }

        // Fetch all matching results
        $result = $connection->fetchAll($select);

        return $result;
    }
}
