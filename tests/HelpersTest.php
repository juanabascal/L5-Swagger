<?php

namespace Tests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class HelpersTest extends TestCase
{
    /** @test */
    public function assetFunctionThrowsExceptionIfFileDoesNotExsist()
    {
        $this->expectException(\L5Swagger\Exceptions\L5SwaggerException::class);
        l5_swagger_asset('asdasd');
    }

    /** @test */
    public function assertFunctionReturnsHttpsUrlWhenSecureAssetsIsTrue(): void
    {
        Config::set('l5-swagger.paths.secure_assets', true);

        self::assertTrue(Str::contains(l5_swagger_asset('swagger-ui.css'), 'https'));
    }

    /** @test */
    public function assertFunctionReturnsHttpUrlWhenSecureAssetsIsFalse(): void
    {
        Config::set('l5-swagger.paths.secure_assets', false);

        self::assertFalse(Str::contains(l5_swagger_asset('swagger-ui.css'), 'https'));
    }

    /** @test */
    public function assertFunctionReturnsHttpsUrlForDocsWhenSecureAssetsIsTrue(): void
    {
        Config::set('l5-swagger.paths.secure_assets', true);

        self::assertTrue(Str::contains(l5_swagger_docs(), 'https'));
    }

    /** @test */
    public function assertFunctionReturnsHttpUrlForDocsWhenSecureAssetsIsFalse(): void
    {
        Config::set('l5-swagger.paths.secure_assets', false);

        self::assertTrue(Str::contains(l5_swagger_docs(), 'http'));
    }
}
