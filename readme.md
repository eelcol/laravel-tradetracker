# Installation

```
composer require eelcol/laravel-tradetracker
```

### Setup .env
Change your .env to include the following variables:
```
TRADETRACKER_ID=...
TRADETRACKER_SECRET=...
```

### Publish assets

```
php artisan vendor:publish --tag=laravel-tradetracker
```

Also run the migrations after publishing:

```
php artisan migrate
```

### Fetch data
#### Load transactions
````
use Eelcol\LaravelTradetracker\Support\Facades\Tradetracker;

// last 7 days
Tradetracker::getTransactions(now()->subDays(7), now());

// today only
Tradetracker::getTransactions(now());
````

#### Make another GET call
Currently, only the call to load transactions is build-in. To make another GET call:

````
use Eelcol\LaravelTradetracker\Support\Facades\Tradetracker;

Tradetracker::get('path', ['param1' => 123]);
````

#### to do
- use Laravel Soap https://laravel-news.com/laravel-soap
- add tests