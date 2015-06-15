#Config
######By Rick Hambrook
-----

A simple Config object that loads a JSON file and lets you access values without having to check if they're set first. Then automatically saves back to the JSON file when your script finishes. It inherits all the getting/setting abilities from `Nest`.

##Example

	$Config = new Config("settings.json");

JSON File (settings.json)

	{
		"foo": "bar",
		"one" {
			"two": "three"
		}
	};

####Use a string as the path parameter

	$value = $Config->get("foo");
	// "bar"

####We're going two levels in this time, so use an array for the path

	$value = $Config->get(["one", "two"]);
	// "three"

####What if we try to get something that isn't there? Does it error?

	$value = $Config->get(["nope", "two"]);
	// returns `null`, not an error

####Or we can specify our own default in case of error

	$value = $Config->get(["nope", "two"], "safe");
	// returns "safe", not an error

##Saving
By default, Config will auto-save at the end of the script. If you instanciate Config with `false` as the second parameter, then it will no longer auto-save.

You can save at any time by using the `save()` function.

	// Save the JSON encoded data to the file and returns `$this`
	$Config->save();

##Shortcuts
You can use `__` (by default) as a separator instead of using an array, then you can do things like...

	// Get a nested value
    $value = Config->one__two
    // "three"

    // Get a nested value that isn't there
    $value = Config->one__bad
    // null

    // Get a nested value, with a default if the value isn't there
    $value = Config->one__bad("default")
    // "default"

    // Get a nested value, with a default if the value isn't there
    $value = Config->one__two = "newthree"
    // sets the value to "newthree" then returns `$this`

##Who is it for?
Config was built for small CLI scripts and tools. But it can be used anywhere.

##Feedback
Tell me if you loved it. Tell me if you hated it. Tell me if you used it and thought "meh". I'm keen to hear your feedback.

##Roadmap
* Add composer support
* Add any other standard documentation that should be included
* Add unit tests
* _If you have an idea, [let me know](mailto:rick@rickhambrook.com)._

##Changelog
* `2015-06-16` feat(license): update license to GPLv3 and attach it properly.
* `2015-06-15` initial public release

##License
Copyright &copy; 2015 Rick Hambrook

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.