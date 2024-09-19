<?php
namespace Maverick\CustomerForm\Model\Resolver;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\Exception\LocalizedException;

class SaveCustomerData implements ResolverInterface
{
    protected $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function resolve(
        \Magento\Framework\GraphQl\Config\Element\Field $field,
        $context,
        \Magento\Framework\GraphQl\Schema\Type\ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($args['name']) || !isset($args['email'])) {
            throw new GraphQlInputException(__('Name and email are required.'));
        }

        $name = $args['name'];
        $email = $args['email'];

        try {
            $connection = $this->resource->getConnection();
            $tableName = $this->resource->getTableName('customer_form_data');

            $connection->insert($tableName, [
                'name' => $name,
                'email' => $email,
            ]);

            return ['success_message' => __('Data saved successfully.')];
        } catch (\Exception $e) {
            throw new LocalizedException(__("Unable to save data: " . $e->getMessage()));
        }
    }
}
