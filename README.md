## geoip2 plugin for ruTorrent

A new geoip plugin working with GeoLite2 (MaxMind DB Files)

### Information

This plugin uses [GeoIP2-php](https://maxmind.github.io/GeoIP2-php/)'s geoip2.phar (v2.9.0) and includes `GeoLite2 Country` MaxMind DB File by MaxMind, Inc.

### Requirements

To be able to use the plugin:

* PHP 'json' extension installed

To be able to display country/city:

* PHP >= 5.4.0
* PHP 'phar' extension installed

### Installation

Place all the plugin files in a directory called 'geoip2' in the rutorrent/plugins directory.

To clone directly from this git repository, run this command in the rutorrent/plugins directory:

`git clone https://github.com/Micdu70/geoip2-rutorrent.git geoip2`

> **Note:** It is important that the plugin directory is named 'geoip2' so that the supporting files are loaded correctly.

> **Warning:** Disable or remove the original 'geoip' plugin.

> **Info:** `GeoLite2 Country` database (2018-11-20) included.

### How-to update or change database

GeoLite2 Free Downloadable Databases: https://dev.maxmind.com/geoip/geoip2/geolite2/#Downloads

Download MaxMind DB binary, gzipped `GeoLite2 Country` or `GeoLite2 City`, extract and find

* `GeoLite2-Country.mmdb` file (country info only)

-or-

* `GeoLite2-City.mmdb` file (country & city info)

and move it in the `database` geoip2 plugin directory.

> **Info:** If both `GeoLite2-Country.mmdb` and `GeoLite2-City.mmdb` are installed, `GeoLite2-City.mmdb` is used.
