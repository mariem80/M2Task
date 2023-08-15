<?php
namespace Tasks\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class CreateQuestion implements ResolverInterface
{
    protected $moduleDataSetup;
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): string
    {
        $title = $args['input']['title'];
        $answer = $args['input']['answer'];
        $status = $args['input']['status'];
        $categoryId = $args['input']['category_id'];

        $connection = $this->moduleDataSetup->getConnection();
        $questionTable = $this->moduleDataSetup->getTable('question');

        $data = [
            'title' => $title,
            'answer' => $answer,
            'status' => $status,
            'category_id' => $categoryId,
        ];

        $connection->insert($questionTable, $data);

        return 'Question added successfully.';
    }
}
