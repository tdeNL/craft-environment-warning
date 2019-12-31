# Environment Warning Plugin for [Craft CMS 3](https://craftcms.com/)

![Screenshot](https://github.com/tdeNL/craft-environment-warning/blob/master/resources/screenshot.png?raw=true)

This plugin has the ability to show a warning flash message on top of the website to warn the user he/she is visiting a non-production website.
This is useful when your website has multiple environments such as staging/test/accept alongside production.
Often, clients keep working on non-production websites unintentionally after the website is live.

Additionally, when the website is deployed from a Git-repository, the current branch will also be shown.

## Requirements

This plugin requires:
* Craft CMS 3.2 or later

## Installation

This plugin can either be installed through the Plugin Store or using Composer.

### Plugin Store

- In the Craft Control Panel, go to Settings -> Plugins
- Search for 'Environment Warning'
- Hit the "Install" button

### Composer

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Download the plugin using Composer

        composer require tde/craft-environment-warning

3. In the Craft Control Panel, go to Settings → Plugins
 
4. Hit the "Install" button for 'Environment Warning'.

## Usage

The plugin will output a flash message by being called from a hook. 
We recommend placing this hook at the top of your `layout.html.twig`-file, straight after your opening `body`-tag.

```twig
<html>
    <head>
        <title>Your fancy website</title>
    </head>
    <body>
        {% hook 'show-environment-warning' %}

        {# the rest of your site... #}
        {% block main %}{% endblock %}

    </body>
</html>
```

To configure the flash message, the following Dot-Env settings can be used:

```dotenv
ENVIRONMENT_WARNING_ENABLED=true
ENVIRONMENT_WARNING_PRODUCTION_URL="https://www.your-production-site.com"
```

---

Brought to you by [TDE](https://www.tde.nl/en)
