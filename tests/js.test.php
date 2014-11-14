<?php

use BEM\BH;

class jsTest extends PHPUnit_Framework_TestCase {

    /**
     * @before
     */
    function setupBhInstance () {
        $this->bh = new BH();
    }

    function test_it_should_return_js____ () {
        $this->bh->match('button', function ($ctx) {
            $this->assertEquals(
                true,
                $ctx->js()
            );
        });
        $this->bh->apply(['block' => 'button', 'js' => true]);
    }
    function test_it_should_set_js____ () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(true);
        });
        $this->assertEquals(
            '<div class="button i-bem" onclick="return {&quot;button&quot;:{}}"></div>',
            $this->bh->apply(['block' => 'button'])
        );
    }
    function test_it_should_not_set_js___ () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(false);
        });
        $this->assertEquals(
            '<div class="button"></div>',
            $this->bh->apply(['block' => 'button'])
        );
    }
    function test_it_should_set_elem_js___ () {
        $this->bh->match('button__control', function ($ctx) {
            $ctx->js(true);
        });
        $this->assertEquals(
            '<div class="button">' .
                '<div class="button__control i-bem" onclick="return {&quot;button__control&quot;:{}}"></div>' .
            '</div>',
            $this->bh->apply(['block' => 'button', 'content' => ['elem' => 'control']])
        );
    }
    function test_it_should_not_override_user_js__ () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(['a' => 2]);
        });
        $this->assertEquals(
            '<div class="button i-bem" onclick="return {&quot;button&quot;:{&quot;x&quot;:1,&quot;a&quot;:2}}"></div>',
            $this->bh->apply(['block' => 'button', 'js' => ['x' => 1]])
        );
    }
    function test_it_should_not_override_later_declarations__ () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(false);
        });
        $this->bh->match('button', function ($ctx) {
            $ctx->js(true);
        });
        $this->assertEquals(
            '<div class="button i-bem" onclick="return {&quot;button&quot;:{}}"></div>',
            $this->bh->apply(['block' => 'button'])
        );
    }
    function test_it_should_override_later_declarations_with_force_fla__g () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(false, true);
        });
        $this->bh->match('button', function ($ctx) {
            $ctx->js(true);
        });
        $this->assertEquals(
            '<div class="button"></div>',
            $this->bh->apply(['block' => 'button'])
        );
    }
    function test_it_should_override_user_declarations_with_force_fla__g () {
        $this->bh->match('button', function ($ctx) {
            $ctx->js(false, true);
        });
        $this->assertEquals(
            '<div class="button"></div>',
            $this->bh->apply(['block' => 'button', 'js' => ['a' => 1]])
        );
    }
}
