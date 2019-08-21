<?php
namespace App\Http\Api\Backend\Controller;

use App\Http\Filter\Auth\Authenticator;
use App\Http\Filter\RateLimit\RateLimiter;
use App\Http\Filter\RateLimit\Redis\RedisRateLimitFallbackUser;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\{Cors};
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

trait ControllerTrait
{
    public function behaviors()
    {
        return [
            'cors' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => Yii::$app->params['api.cors.origin'],
                    'Access-Control-Request-Method' => Yii::$app->params['api.cors.methods'],
                    'Access-Control-Request-Headers' => Yii::$app->params['api.cors.headers'],
                    'Access-Control-Allow-Credentials' => Yii::$app->params['api.cors.allowCredentials'],
                    'Access-Control-Max-Age' => Yii::$app->params['api.cors.maxAge'],
                    'Access-Control-Expose-Headers' => Yii::$app->params['api.cors.exposeHeaders'],
                ],
            ],
            'authenticator' => [
                'class' => Authenticator::class,
                'optional' => [
                    'options',
                ],
                'authMethods' => [
                    'query' => [
                        'class' => QueryParamAuth::class,
                        'tokenParam' => 'access_token',
                    ],
                    'bearer' => [
                        'class' => HttpBearerAuth::class,
                    ],
                ],
            ],
            'verb' => [
                'class' => VerbFilter::class,
                'actions' => $this->verbs(),
            ],
            'rateLimiter' => [
                'class' => \RazonYang\Yii2\RateLimiter\Redis\RateLimiter::class,
                'redis' => 'redis',
                'capacity' => Yii::$app->params['api.rateLimiter.capacity'],
                'rate' => Yii::$app->params['api.rateLimiter.rate'],
                'limitPeriod' => Yii::$app->params['api.rateLimiter.limitPeriod'],
                'prefix' => Yii::$app->params['api.rateLimiter.prefix'],
                'ttl' => Yii::$app->params['api.rateLimiter.ttl'],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function verbs()
    {
        return [];
    }
}
