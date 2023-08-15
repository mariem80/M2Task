<?php
namespace Tasks\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class UpdateCategory implements ResolverInterface
{
    protected $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): string
    {
        $id = $args['input']['id']; //ele fel schema
        $newCategory = $args['input']['new_category']; //ele fel schema

        $connection = $this->moduleDataSetup->getConnection();
        $categoryTable = $this->moduleDataSetup->getTable('category');

        $updatedData = [
            'category_name' => $newCategory,  //column name
        ];

        $where = ['category_id = ?' => $id]; //column name

        $connection->update($categoryTable, $updatedData, $where);

        return 'Category updated successfully.';
    }
}
