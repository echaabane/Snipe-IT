<?php

namespace Tests;

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Support\InteractsWithSettings;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    private array $globallyDisabledMiddleware = [
        SecurityHeaders::class,
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware($this->globallyDisabledMiddleware);

        if (collect(class_uses_recursive($this))->contains(InteractsWithSettings::class)) {
            $this->setUpSettings();
        }
    }
}
