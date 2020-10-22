# Network-Path-Test

This script let users to test whether a signal can travel between two devices in a given amount of time or less.

## Installation

This scripts utilizes PHP, [click here](https://www.php.net/distributions/php-7.4.11.tar.bz2) to download latest PHP.


## Usage
Open terminal window and enter the following command:
```'PHP
php.exe -f [path to app folder]\network-path-test\index.php
```
#### input format:
[Device From] [DeviceTo] [Time] 
(e.g A F 1000 followed by ENTER key)

#### Sample inputs & outputs
* A F 1000  # returns 'Path not found'
* A D 100   # returns 'A => C => D => 50'


## License
[MIT](https://choosealicense.com/licenses/mit/)