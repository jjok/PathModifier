<?php

namespace jjok\PathModifier;

/**
 * 
 * @author Jonathan Jefferies
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
	 * 
	 * @param string $path the path to be added.
	 * @param string $path,... More paths to be added.
	 * @return boolean
	 */
	public static function append($path) {
		return self::setArray(
			array_merge(self::getArray(), func_get_args())
		);
	}
	
	/**
	 * 
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
