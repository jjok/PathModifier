<?php

/**
 * Copyright (c) 2013 Jonathan Jefferies
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the
 * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
 * sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace jjok\PathModifier;

/**
 * Change your include path.
 * @author Jonathan Jefferies
 * @version 1.0.0
 */
class PathModifier {

	/**
	 * Get the current include path.
	 * @return string
	 */
	public static function get() {
		return get_include_path();
	}
	
	/**
	 * Set the include path.
	 * @param string $path
	 * @return boolean
	 */
	public static function set($path) {
		return set_include_path($path) !== false;
	}
	
	/**
	 * Restore the include path back to its original master value.
	 */
	public static function restore() {
		restore_include_path();
	}
	
	/**
	 * Append the include path.
	 * @param string $path The path to be added.
	 * @param string $path,... More paths to be added.
	 * @return boolean
	 */
	public static function append($path) {
		return self::setArray(
			array_merge(self::getArray(), func_get_args())
		);
	}
	
	/**
	 * Remove an item from the include path.
	 * @param string $path The path to be removed.
	 * @param string $path,... More paths to be removed.
	 * @return boolean
	 */
	public static function remove($path) {
		return self::setArray(
			array_diff(self::getArray(), func_get_args())
		);
	}
	
	/**
	 * Get the include path as an array.
	 * @return string[]
	 */
	protected static function getArray() {
		return explode(PATH_SEPARATOR, self::get());
	}
	
	/**
	 * Set the include path from an array.
	 * @param array $paths
	 * @return boolean
	 */
	protected static function setArray(array $paths) {
		return self::set(implode(PATH_SEPARATOR, $paths));
	}
}
