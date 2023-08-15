<?php
namespace Tasks\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class DeleteCategory implements ResolverInterface
{
    protected $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): string
    {
        $id = $args['id']; //ele fel schema

        $connection = $this->moduleDataSetup->getConnection();
        $categoryTable = $this->moduleDataSetup->getTable('category');

        $connection->delete($categoryTable,['category_id = ?' => $id]); //el column name

        return 'Category deleted successfully.';
    }
}
