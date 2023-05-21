<p align="center">
    <a href="https://phalcon.io/en-us" target="_blank">
        <img src="https://assets.phalconphp.com/phalcon/images/svg/phalcon-logo-white-105x40.svg" height="100px">
    </a>
    <h1 align="center">Phalcon 4 Starter kit</h1>
    <br>
</p>

The starter kit includes three tiers: front end, back end, and console, each of which
is a separate Phalcon application.

REQUIREMENT
-------------------
- Phalcon 4.x

DIRECTORY STRUCTURE
-------------------

```
common
    components/          contains shared components
    config/              contains shared configurations
    helpers/             contains helper classes
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    tasks/               contains console commands
    migrations/          contains database migrations
    models/              contains console-specific model classes
backend
    cache/               contains files generated during runtime
    components/          contains BE components
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    cache/               contains files generated during runtime
    components/          contains FE components
    config/              contains FE configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
vendor/                  contains dependent 3rd-party packages
```
