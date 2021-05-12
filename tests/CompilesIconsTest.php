<?php

declare(strict_types=1);

namespace Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Config;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladeMicrons\BladeMicronsServiceProvider;

class CompilesIconsTest extends TestCase
{
    /** @test */
    public function it_compiles_a_single_anonymous_component()
    {
        $result = svg('microns-bold')->toHtml();

        // Note: the empty class here seems to be a Blade components bug.
        $expected = <<<'SVG'
            <svg viewBox="0 0 416 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>bold</title><path d="M214 80Q266 80 299 107 331 134 331 176 331 201 320 222 308 243 291 251L291 253Q319 262 336 284 352 306 352 335 352 377 321 405 290 432 242 432L64 432 64 80 214 80ZM218 224Q239 224 253 211 267 198 267 180 267 164 254 154 240 144 218 144L128 144 128 224 218 224ZM236 368Q258 368 273 357 288 345 288 328 288 309 274 299 259 288 236 288L128 288 128 368 236 368Z" /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('microns-bold', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" viewBox="0 0 416 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>bold</title><path d="M214 80Q266 80 299 107 331 134 331 176 331 201 320 222 308 243 291 251L291 253Q319 262 336 284 352 306 352 335 352 377 321 405 290 432 242 432L64 432 64 80 214 80ZM218 224Q239 224 253 211 267 198 267 180 267 164 254 154 240 144 218 144L128 144 128 224 218 224ZM236 368Q258 368 273 357 288 345 288 328 288 309 274 299 259 288 236 288L128 288 128 368 236 368Z" /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('microns-bold', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" viewBox="0 0 416 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>bold</title><path d="M214 80Q266 80 299 107 331 134 331 176 331 201 320 222 308 243 291 251L291 253Q319 262 336 284 352 306 352 335 352 377 321 405 290 432 242 432L64 432 64 80 214 80ZM218 224Q239 224 253 211 267 198 267 180 267 164 254 154 240 144 218 144L128 144 128 224 218 224ZM236 368Q258 368 273 357 288 345 288 328 288 309 274 299 259 288 236 288L128 288 128 368 236 368Z" /></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-microns.class', 'awesome');

        $result = svg('microns-bold')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" viewBox="0 0 416 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>bold</title><path d="M214 80Q266 80 299 107 331 134 331 176 331 201 320 222 308 243 291 251L291 253Q319 262 336 284 352 306 352 335 352 377 321 405 290 432 242 432L64 432 64 80 214 80ZM218 224Q239 224 253 211 267 198 267 180 267 164 254 154 240 144 218 144L128 144 128 224 218 224ZM236 368Q258 368 273 357 288 345 288 328 288 309 274 299 259 288 236 288L128 288 128 368 236 368Z" /></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-microns.class', 'awesome');

        $result = svg('microns-bold', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" viewBox="0 0 416 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>bold</title><path d="M214 80Q266 80 299 107 331 134 331 176 331 201 320 222 308 243 291 251L291 253Q319 262 336 284 352 306 352 335 352 377 321 405 290 432 242 432L64 432 64 80 214 80ZM218 224Q239 224 253 211 267 198 267 180 267 164 254 154 240 144 218 144L128 144 128 224 218 224ZM236 368Q258 368 273 357 288 345 288 328 288 309 274 299 259 288 236 288L128 288 128 368 236 368Z" /></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    protected function getPackageProviders($app)
    {
        return [
            BladeIconsServiceProvider::class,
            BladeMicronsServiceProvider::class,
        ];
    }
}
