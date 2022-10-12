# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]
### Added
- Support PHP v7.4 and v8.
- Multibyte support for ellipsis function.
- New function to convert stringly booleans to bool.
### Changed
- **BC break**: Use namespaced functions, i.e. `\Phlib\String\ellipsis()`.
- Throw exception if ellipsis function maxLength is too short for ellipsis.
### Removed
- **BC break**: Removed support for PHP versions <= 7.3 as they are no longer
  [actively supported](https://php.net/supported-versions.php)
  by the PHP project.

## [1.0.0] - 2015-03-09
 * Initial release
