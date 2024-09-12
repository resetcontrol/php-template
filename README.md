# PHP Template

[![Code style: Prettier](https://img.shields.io/badge/Code_style-Prettier-ff69b4.svg)](https://prettier.io/)

Template for [PHP](https://www.php.net/) `v5.3` projects.

## Usage

Create a new `php-template`-based project using
[degit](https://github.com/Rich-Harris/degit).

```sh
npx degit resetcontrol/php-template/root project-name
cd project-name
git init
npm install
```

_Replace `project-name` with the name of your project._

_**Keep in mind:** Run `git init` before `npm install` so husky can install its
git hooks._

### Post-install

- Change project name and description in `package.json`
- Change project name (multiple instances) in `package-lock.json`
- Change project name (multiple instances) and description in `README.md`
- Review `[TODO]` comments in `README.md`
- Change page title in `index.php`
- Change app title in `src/app.php`

## What's included

### Editor settings

- [EditorConfig](https://editorconfig.org/)
- [Visual Studio Code](https://code.visualstudio.com/)

### Version control

- [Git](https://git-scm.com/)
- [husky](https://typicode.github.io/husky/)
- [lint-staged](https://github.com/lint-staged/lint-staged)

### Linters and formatters

- [Prettier](https://prettier.io/)
- [markdownlint](https://github.com/DavidAnson/markdownlint-cli2)

## Project structure

```text
./
  lib/
  polyfills/
  public/
  src/
    actions/
    db/
    utils/
    views/
    app.php
    init.php
    router.php
    styles.css
  vendor/
  index.php
```

### `./`

The root of the project. It contains all the config files and directories.

### `lib/`

Dependency resolution for libraries under `vendor/`.

_This will be removed once we use [composer](https://getcomposer.org/) which
requires php `v5.5` or greater._

### `polyfills/`

Implementation of PHP features included in versions greater than `5.3`.

### `src/`

Where the development happens. It contains the source files.

### `src/actions/`

Form action handlers.

### `src/db/`

SQL queries.

### `src/utils/`

General-purpose utility functions.

### `src/views/`

SPA views.

### `vendor/`

3rd-party dependencies.

## NPM scripts

```json
{
  "format": "prettier --write --cache .",
  "lint:md": "markdownlint-cli2 **/*.md !node_modules",
  "deps:check": "ncu",
  "deps:update": "ncu --upgrade && npm install"
}
```

## VSCode recommended extensions

- [editorconfig.editorconfig](https://marketplace.visualstudio.com/items?itemName=editorconfig.editorconfig)
- [esbenp.prettier-vscode](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode)
- [dbaeumer.vscode-eslint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
- [davidanson.vscode-markdownlint](https://marketplace.visualstudio.com/items?itemName=davidanson.vscode-markdownlint)
- [bmewburn.vscode-intelephense-client](https://marketplace.visualstudio.com/items?itemName=bmewburn.vscode-intelephense-client)

VSCode is configured to recommend the previous extensions from the extensions
view (via `.vscode/extensions.json`).
