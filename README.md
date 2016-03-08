# NexySlackBundle

Symfony bundle integration of the popular [maknz/slack](https://github.com/maknz/slack) library.

[![Latest Stable Version](https://poser.pugx.org/nexylan/slack-bundle/v/stable)](https://packagist.org/packages/nexylan/slack-bundle)
[![Latest Unstable Version](https://poser.pugx.org/nexylan/slack-bundle/v/unstable)](https://packagist.org/packages/nexylan/slack-bundle)
[![License](https://poser.pugx.org/nexylan/slack-bundle/license)](https://packagist.org/packages/nexylan/slack-bundle)
[![Dependency Status](https://www.versioneye.com/php/nexy:slack-bundle/badge.svg)](https://www.versioneye.com/php/nexylan:slack-bundle)
[![Reference Status](https://www.versioneye.com/php/nexy:slack-bundle/reference_badge.svg)](https://www.versioneye.com/php/nexylan:slack-bundle/references)

[![Total Downloads](https://poser.pugx.org/nexylan/slack-bundle/downloads)](https://packagist.org/packages/nexylan/slack-bundle)
[![Monthly Downloads](https://poser.pugx.org/nexylan/slack-bundle/d/monthly)](https://packagist.org/packages/nexylan/slack-bundle)
[![Daily Downloads](https://poser.pugx.org/nexylan/slack-bundle/d/daily)](https://packagist.org/packages/nexylan/slack-bundle)

[![Build Status](https://travis-ci.org/nexylan/NexySlackBundle.svg?branch=master)](https://travis-ci.org/nexylan/NexySlackBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nexylan/NexySlackBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/nexylan/NexySlackBundle/?branch=master)
[![Code Climate](https://codeclimate.com/github/nexylan/NexySlackBundle/badges/gpa.svg)](https://codeclimate.com/github/nexylan/NexySlackBundle)
[![Coverage Status](https://coveralls.io/repos/nexylan/NexySlackBundle/badge.svg?branch=master)](https://coveralls.io/r/nexylan/NexySlackBundle?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/15e2cfed-cfb8-4856-ac0d-92768fc0c324/mini.png)](https://insight.sensiolabs.com/projects/8a6b5dd0-e974-478c-92ee-43125cb7bae3)

## Documentation

All the installation and usage instructions are located in this README.
Check it for specific version:

* [__1.x__](https://github.com/Soullivaneuh/IsoCodesValidator/tree/master) with support for Symfony `>=2.8`

## Prerequisites

This version of the project requires:

* PHP 5.6+
* Symfony 2.8+

## Installation

First of all, you need to require this library through composer:

``` bash
$ composer require nexylan/slack-bundle
```

Then, enable the bundle on the `AppKernel` class:

``` php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Nexy\SlackBundle\NexySlackBundle(),
    );

    // ...

    return $bundles
}
```

Configure the bundle to your needs (example with default values):

```yaml
nexy_slack:

    # The Slack API Incoming WebHooks URL.
    endpoint:             ~ # Required
    channel:              null
    username:             null
    icon:                 null
    link_names:           false
    unfurl_links:         false
    unfurl_media:         true
    allow_markdown:       true
    markdown_in_attachments:  []
```

Excepted `endpoint`, all the other configuration keys are related to the Slack client default settings.

All those settings are described on the [maknz/slack documentation](https://github.com/maknz/slack#settings).

## Usage

The Slack client instance can be retrieved from the `nexy_slack.client` service.

Here is an example:

```php
<?php

namespace AppBundle\Controller;

use Maknz\Slack\Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $slack = $this->get('nexy_slack.client');

        $message = $slack->createMessage();

        $message
            ->to('#test')
            ->from('John Doe')
            ->withIcon(':ghost:')
            ->setText('This is an amazing message!')
        ;

        $message->attach(new Attachment([
            'color'     => '#CCC',
            'text'      => 'More info about attachment on <https://api.slack.com/docs/formatting|Slack documentation>!',
            'mrkdwn_in' => ['text'],
        ]));

        $slack->sendMessage($message);
    }
}
```

All the how to manipulate the Slack client is on the [maknz/slack documentation](https://github.com/maknz/slack#sending-messages).
