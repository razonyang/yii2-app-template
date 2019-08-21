<?php

return [
    'class' => \yii\gii\Module::class,
    'generators' => [
        'model' => [
            'class' => \yii\gii\generators\model\Generator::class,
            'ns' => 'App\Model',
            'baseClass' => 'App\Model\ActiveRecord',
            'useTablePrefix' => true,
            'generateLabelsFromComments' => true,
            'queryNs' => 'App\Model',
            'singularize' => true,
            'standardizeCapitals' => true,
            'enableI18N' => true,
            'queryBaseClass' => \App\Db\ActiveQuery::class,
        ],
        'module' => [
            'class' => \App\Gii\Generator\Module\Generator::class,
        ],
        'job' => [
            'class' => \App\Queue\Gii\Generator::class,
        ],
    ],
];
