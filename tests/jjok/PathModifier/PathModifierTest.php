<?php

require_once 'src/jjok/PathModifier/PathModifier.php';

use jjok\PathModifier\PathModifier;

class PathModiferTest extends PHPUnit_Framework_TestCase {
	
	public function tearDown() {
		restore_include_path();
	}
	
	/**
	 * @covers jjok\PathModifier\PathModifier::get()
	 */
	public function testGetReturnsCurrentIncludePath() {
		$this->assertSame(get_include_path(), PathModifier::get());
	}
	
	/**
	 * @covers jjok\PathModifier\PathModifier::set()
	 */
	public function testPathCanBeSet() {
		PathModifier::set('my-path');
		$this->assertSame('my-path', get_include_path());
	}
	
	/**
	 * @covers jjok\PathModifier\PathModifier::restore()
	 */
	public function testPathCanBeRestored() {
		$initial_path = get_include_path();
		PathModifier::set('my-path');
		PathModifier::restore();
		$this->assertSame($initial_path, get_include_path());
	}
	
	/**
	 * @covers jjok\PathModifier\PathModifier::append()
	 */
	public function testPathCanBeAppended() {
		$initial_path = get_include_path();
		PathModifier::append('path1');
		$this->assertSame(
			$initial_path.PATH_SEPARATOR.'path1',
			get_include_path()
		);
		
		PathModifier::append('path2', 'path3');
		$this->assertSame(
			$initial_path.PATH_SEPARATOR.'path1'.PATH_SEPARATOR.'path2'.PATH_SEPARATOR.'path3',
			get_include_path()
		);
	}
	
	public function testPathsCanBeRemoved() {
		set_include_path('path1'.PATH_SEPARATOR.'path2'.PATH_SEPARATOR.'path3'.PATH_SEPARATOR.'path4');
		
		PathModifier::remove('path2');
		$this->assertSame(
			'path1'.PATH_SEPARATOR.'path3'.PATH_SEPARATOR.'path4',
			get_include_path()
		);
		
		PathModifier::remove('path4', 'path1');
		$this->assertSame(
			'path3',
			get_include_path()
		);
	}
}
