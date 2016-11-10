<?php
use razorbacks\walton\news\feed\Layout;

class LayoutTest extends PHPUnit_Framework_TestCase {
	public function outputViewDataProvider(){
		return array(
			'list' => array('list'),
		);
	}

	/**
	 * @dataProvider outputViewDataProvider
	 */
	public function testCanGenerateOutput($output){
		$json     = file_get_contents(__DIR__."/json/posts.json");
		$expected = file_get_contents(__DIR__."/html/$output.html");

		$actual = (string)(new Layout($json, array(40, 22), 4, $output));

		$this->assertEquals($expected, $actual);
	}

	/**
	 * @testdox Can invalidate JSON
	 * @expectedException InvalidArgumentException
	 */
	public function testCanInvalidateJSON(){
		$invalid = file_get_contents(__DIR__.'/json/invalid.json');
		$generator = new Layout($invalid, 1, 1, 'list');
		$this->assertTrue(false);
	}
}
