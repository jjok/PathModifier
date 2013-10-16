PathModifier
============

[![Build Status](https://travis-ci.org/jjok/PathModifier.png?branch=master)](https://travis-ci.org/jjok/PathModifier)

Change your include path.

Examples
--------

Get the current include path.

	PathModifier::get();
	
Set the include path, overwriting the current value.
	
	PathModifier::set('/my/new/path');

Append the current include path.

	PathModifier::append('/my/new/path');
	PathModifier::append('/my/new/path', '/my/new/path2');

Remove a path.

	PathModifier::remove('/my/new/path');
	PathModifier::remove('/my/new/path', '/my/new/path2');

Restore the include path to its original value.

	PathModifier::restore();

Copyright (c) 2013 Jonathan Jefferies
