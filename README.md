LOGman Mosets Tree plugin
========================

Plugin for integrating [Mosets Tree](https://www.mosets.com/tree/) with LOGman. [LOGman](https://www.joomlatools.com/extensions/logman/) is a user analytics and audit trail solution for Joomla.

## Installation

### Composer

You can install this package using [Composer](https://getcomposer.org/). Create a `composer.json` file inside the root directory of your Joomla! site containing the following code:

```
{
    "require": {        
        "joomlatools/plg_logman_mtree": "dev-master"
    },
    "minimum-stability": "dev"
}
```

Run composer install.

### Package

For downloading an installable package just make use of the **Download ZIP** button located in the right sidebar of this page.

After downloading the package, you may install this plugin using the Joomla! extension manager.

## Usage

After the package is installed, make sure to enable the plugin and that both LOGman and Mosets Tree are installed.

## Supported activities

The following Mosets Tree actions are currently logged for listings:

* Add
* Edit
* Delete
* Approve
* Publish/Unpublish

## Limitations

Category actions are not logged since the component is not triggering events for those actions.
