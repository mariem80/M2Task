<?php
namespace Tasks\FAQs\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class AllQuestions implements ResolverInterface
{
    protected $moduleDataSetup;
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null): array
    {
        $connection = $this->moduleDataSetup->getConnection();
        $questionTable = $this->moduleDataSetup->getTable('question');

        $select = $connection->select()
            ->from($questionTable);

        $questionsData = $connection->fetchAll($select);

        return $questionsData;
    }
}
