
##  Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/sarfraj-creator/kitchen-spurs-backend.git
cd restaurant-analytics-backend

```

#### Install dependencies
``` bash
composer install

```

####   Configure environment

```bash
env example

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=restaurant_analytics
DB_USERNAME=postgres
DB_PASSWORD=yourpassword

MEILISEARCH_HOST=http://127.0.0.1:7700
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

### Generate app key

```` bash

php artisan key:generate

````

### Start Laravel server 
``` bash
php artisan serve

```


### 2 Database Setup

### Create PostgreSQL database

``` bash
createdb restaurant_analytics

```

#### Run migrations
```bash
php artisan migrate

```

#### Seed mock data

```bash

php artisan db:seed

```


#### 3 Meilisearch Setup

### Install Meilisearch 
```bash 

curl -L https://install.meilisearch.com | sh
./meilisearch --master-key=masterKey
```

### Import restaurant data
```bsh
php artisan scout:import "App\Models\Restaurant"
Now you can search restaurants by name, cuisine, or location.
```


### 4 Redis Setup

### Start Redis

``` bash 
redis-server
```

```bash
Enable Laravel cache
```

### API Endpoints

``` bash

GET /api/restaurants
Search, sort, and filter restaurants
Supports Meilisearch full-text search

 GET /api/orders/trends
Query params:
restaurant_id
start_date, end_date
peak_hour
min_order_amount

Returns:


[
  {
    "day": "2025-06-23",
    "total": "546.00",
    "order_count": 1,
    "average_order_value": "546.00",
    "peak_hour": "13"
  }
]



GET /api/restaurants/top

Returns top 3 restaurants by revenue


```


### below is the env file to run backend application


``` bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:9FuB+rFj6APmWm+z1bEryHA/ufFwulmedacskcmbmOs=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug




DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=restaurant_dashboard
DB_USERNAME=postgres
DB_PASSWORD=123


BROADCAST_DRIVER=log
CACHE_DRIVER=redis
REDIS_CLIENT=predis


FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"



SCOUT_DRIVER=meilisearch

MEILISEARCH_HOST=http://127.0.0.1:7700
MEILISEARCH_KEY=restaurantAnalyticsKey123

```