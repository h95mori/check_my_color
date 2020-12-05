<?php
class CLTest extends PHPUnit_Framework_TestCase {
    function test1(){
        $output = do_shortcode('[mymitsu]292[/mymitsu]');
        $expected = '<iframe src="https://my-mitsu.jp/estimation/292" id="mymitsu" width="640" height="480"></iframe>';
        $this->assertEquals($expected, $output);
    }
}
