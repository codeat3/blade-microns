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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360 480" fill="currentColor"><title>bold</title><path d="M80 380l125 0q38-1 61-22 23-22 24-58 0-26-14-43-14-18-36-21l0-4q15-5 25-22 10-17 10-36-1-35-27-55-27-19-70-19l-98 0 0 280z m40-40l0-80 89 0q18 0 30 11 11 11 11 29 0 18-11 29-12 11-30 11l-89 0z m0-120l0-80 72 0q19 0 31 11 12 11 12 29 0 18-12 29-12 11-31 11l-72 0z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_classes_to_icons()
    {
        $result = svg('microns-bold', 'w-6 h-6 text-gray-500')->toHtml();

        $expected = <<<'SVG'
            <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360 480" fill="currentColor"><title>bold</title><path d="M80 380l125 0q38-1 61-22 23-22 24-58 0-26-14-43-14-18-36-21l0-4q15-5 25-22 10-17 10-36-1-35-27-55-27-19-70-19l-98 0 0 280z m40-40l0-80 89 0q18 0 30 11 11 11 11 29 0 18-11 29-12 11-30 11l-89 0z m0-120l0-80 72 0q19 0 31 11 12 11 12 29 0 18-12 29-12 11-31 11l-72 0z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_styles_to_icons()
    {
        $result = svg('microns-bold', ['style' => 'color: #555'])->toHtml();

        $expected = <<<'SVG'
            <svg style="color: #555" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360 480" fill="currentColor"><title>bold</title><path d="M80 380l125 0q38-1 61-22 23-22 24-58 0-26-14-43-14-18-36-21l0-4q15-5 25-22 10-17 10-36-1-35-27-55-27-19-70-19l-98 0 0 280z m40-40l0-80 89 0q18 0 30 11 11 11 11 29 0 18-11 29-12 11-30 11l-89 0z m0-120l0-80 72 0q19 0 31 11 12 11 12 29 0 18-12 29-12 11-31 11l-72 0z"/></svg>
            SVG;

        $this->assertSame($expected, $result);
    }

    /** @test */
    public function it_can_add_default_class_from_config()
    {
        Config::set('blade-microns.class', 'awesome');

        $result = svg('microns-bold')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360 480" fill="currentColor"><title>bold</title><path d="M80 380l125 0q38-1 61-22 23-22 24-58 0-26-14-43-14-18-36-21l0-4q15-5 25-22 10-17 10-36-1-35-27-55-27-19-70-19l-98 0 0 280z m40-40l0-80 89 0q18 0 30 11 11 11 11 29 0 18-11 29-12 11-30 11l-89 0z m0-120l0-80 72 0q19 0 31 11 12 11 12 29 0 18-12 29-12 11-31 11l-72 0z"/></svg>
            SVG;

        $this->assertSame($expected, $result);

    }

    /** @test */
    public function it_can_merge_default_class_from_config()
    {
        Config::set('blade-microns.class', 'awesome');

        $result = svg('microns-bold', 'w-6 h-6')->toHtml();

        $expected = <<<'SVG'
            <svg class="awesome w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 360 480" fill="currentColor"><title>bold</title><path d="M80 380l125 0q38-1 61-22 23-22 24-58 0-26-14-43-14-18-36-21l0-4q15-5 25-22 10-17 10-36-1-35-27-55-27-19-70-19l-98 0 0 280z m40-40l0-80 89 0q18 0 30 11 11 11 11 29 0 18-11 29-12 11-30 11l-89 0z m0-120l0-80 72 0q19 0 31 11 12 11 12 29 0 18-12 29-12 11-31 11l-72 0z"/></svg>
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
