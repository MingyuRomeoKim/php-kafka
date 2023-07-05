<?php

namespace MingyuKim\PhpKafka;

use Illuminate\Support\ServiceProvider;

class PhpKafkaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([

        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/kafka-consumer.php' => config_path('kafka-consumer.php'),
            __DIR__ . '/../config/kafka-producer.php' => config_path('kafka-producer.php'),
        ], 'config');
    }
}
