# ZiNETHQ Spark Team Email

[![Laravel 5.3](https://img.shields.io/badge/Laravel-5.3-orange.svg?style=flat-square)](http://laravel.com)
[![Spark 2.0](https://img.shields.io/badge/Spark-2.0-orange.svg?style=flat-square)](https://spark.laravel.com)
[![Source](http://img.shields.io/badge/source-zinethq/spark--team--email-blue.svg?style=flat-square)](https://github.com/zinethq/spark-team-email)
[![Build Status](https://travis-ci.org/ZiNETHQ/spark-team-email.svg?branch=master)](https://travis-ci.org/ZiNETHQ/spark-team-email)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

SparkTeamEmail provides a simple way for Laravel Spark to allow users to have a different email address on a team, without changing their user email address.

## Use case example
Bob Bobbinson is a user of `spark-developer.com`. Bob uses `bob@bob.com` to log in, but `bob@bob.com` is Bob's personal email and `bob.com` is Bob's personal website.

Bob is a member of two teams on `spark-developer.com`, a team for his personal work (`DevBob`) and one for the company he works for (`BigDevelopsLtd`). Bob has been given a work email to use for all things `BigDevelopsLtd` related. However, out of the box Bob can only have one email - the one used to sign into the site.

Spark Team Email allows adding secondary email addresses for a user in the context of a team. In this case Bob can add `bob@BigDevelopsLtd.com` as his email for the team `BigDevelopsLtd`.