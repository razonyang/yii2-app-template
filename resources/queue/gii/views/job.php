<?php
/**
 * @var \yii\web\View $this
 * @var \yii\queue\gii\Generator $generator
 * @var string $jobClass
 * @var string $$ns
 * @var string $baseClass
 * @var string[] $interfaces
 * @var string[] $properties
 */
if ($interfaces) {
    $implements = 'implements ' . implode(', ', $interfaces);
} else {
    $implements = '';
}

echo "<?php\n";
?>
namespace <?= $ns ?>;

/**
 * Class <?= $jobClass ?>.
 */
class <?= $jobClass ?> extends <?= $baseClass ?> <?= $implements ?>

{
<?php if ($generator->retryable): ?>
    use <?= $generator->retryableTrait ?>;
<?php endif; ?>
<?php foreach ($properties as $property): ?>

    public $<?= $property ?>;
<?php endforeach; ?>

    protected function run()
    {
    }
}
