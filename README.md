# symfony4-stuff
All kinds of stuff with Symfony 4 learning ...


## REDIS MEMO

Clear the full app cache, let's just clear the cache for our particular cache pool:

```
php bin/console cache:pool:clear cache.app
```

### Cache Pools

I don't want to cache everything under one big central cache.

```
# app/config/config.yml

framework:
    # ...
    cache:
        app: cache.adapter.redis
        default_redis_provider: "redis://%redis.host%:%redis.port%"
        pools:
            app.cache.widget:
                public: true
                adapter: cache.adapter.redis
                default_lifetime: 100 # 100 seconds
            app.cache.sprocket:
                adapter: cache.adapter.redis
                default_lifetime: 604800 # 1 week in seconds
```