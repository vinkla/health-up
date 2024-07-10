![Example of the health up page](https://github.com/vinkla/health-up/assets/499192/1a5993df-5f6c-4e62-93d7-d246a2bb806c)

# Health Up

> A health check route is served at `/up` and will return a 200 HTTP response if WordPress has booted without any errors.

This is still a **work in progress** and may not be completed yet.

## Installation

Require the package, with Composer, in the root directory of your project.

```sh
composer require vinkla/health-up
```

The plugin will be installed as a [must-use plugin](https://github.com/vinkla/wordplate#must-use-plugins).

## Usage

Visit the `/up` route in your browser to see if WordPress has booted without any errors.

### GitHub Actions

You can use GitHub Actions to ping the `/up` route every hour to make sure your site is up and running.

```yml
name: Ping

on:
  schedule:
    - cron: '0 * * * *'

jobs:
  check_website:
    runs-on: ubuntu-latest

    steps:
      - run: curl -s --head --request GET https://example.com/up/ --connect-timeout 2 --max-time 5 | grep "200" > /dev/null
```
