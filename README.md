# MVC execrise integrated with a CI chain
===============================

##### Travis CI
[![Build Status](https://travis-ci.com/beha20/framework.svg?branch=main)](https://travis-ci.com/beha20/framework)


##### Scrutinizer CI
[![Build Status](https://scrutinizer-ci.com/g/beha20/framework/badges/build.png?b=main)](https://scrutinizer-ci.com/g/beha20/framework/build-status/main)

[![Code Coverage](https://scrutinizer-ci.com/g/beha20/framework/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/beha20/framework/?branch=main)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/beha20/framework/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/beha20/framework/?branch=main)

[![Scrutinizer Code Intelligence Status](https://scrutinizer-ci.com/g/beha20/framework/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/g/beha20/framework/?branch=main)


This is a short simplified guide on how to integrate your Git repo on GitHub / GitLab with the construction services Travis and Scrutinizer.

The purpose is mainly to show the configuration files that work for Travis and Scrutinizer respectively.

Travis
-------------------------------

The service is [Travis CI] (https://www.travis-ci.com/) (note that it is .com and not .org).

You can use a given account from GitHub (or similar) to log in to Travis.

Link Travis with your repos on GitHub / GitLab.

Do not forget the [documentation] (https://docs.travis-ci.com/).

Add a `.travis.yml` configuration file (see [Travis configuration file example] (https://github.com/dbwebb-se/mvc/blob/main/example/ci/.travis.yml)) to your repo.

Read more about [PHP configuration file] (https://docs.travis-ci.com/user/languages/php/).

Adjust which versions of PHP you want to test against and how to install the development environment and run the tests.

Commit and push to GitHub / GitLab.

Travis will now be notified and check out your repo and execute the instructions according to the configuration file.

Scrutinizer
-------------------------------

The service is [Scrutinizer CI] (https://scrutinizer-ci.com/).

You can use a given account from GitHub (or similar) to log in to Scrutinizer.

Link Scrutinizer with one of your repositories on GitHub / GitLab.

Do not forget the [documentation] (https://scrutinizer-ci.com/docs/).

Add a configuration file `.scrutinizer.yml` (see [example of configuration file for Scrutinizer] (https://github.com/dbwebb-se/mvc/blob/main/example/ci/.scrutinizer.yml)) in your repo.

Read more about [PHP configuration file] (https://scrutinizer-ci.com/docs/guides/php/continuous-integration-deployment).

Adjust which versions of PHP you want to test against and how to install the development environment and run the tests. Also double check which paths are excluded from driving.

Commit and push to GitHub / GitLab.

Scrutinizer will now be notified and check out your repo and execute the instructions according to the configuration file.
