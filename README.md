

# Laravel Movies App

A movie app based on a rest api from TMdb using laravel+livewire


## Installation

1. Clone the repo and `cd` into it
2.  `composer install`
3. Rename or copy `.env.example` file to `.env`
4. Set your `TMDB_APP_KEY` in your `.env` file. You can get an API key [here](https://www.themoviedb.org/documentation/api). Make sure to use the "API Read Access Token (v3 auth)" from the TMDb dashboard.
5. create your database and rename in '.env'
6. migrate your database
7. `php artisan key:generate`
8. `php artisan serve` or use Laravel Valet or Laravel Homestead
9. Visit `localhost:8000` in your browser

