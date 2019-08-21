<?php
namespace App\Http\Api\Frontend\Controller;

use App\Http\Filter\Auth\Authenticator;
use App\Http\Filter\RateLimit\RateLimiter;
use App\Http\Filter\RateLimit\Redis\RedisRateLimitFallbackUser;
use yii\filters\VerbFilter;
use yii\filters\{Cors};
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use Yii;

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
                'class' => RateLimiter::class,
                'fallbackUser' => RedisRateLimitFallbackUser::class,
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
