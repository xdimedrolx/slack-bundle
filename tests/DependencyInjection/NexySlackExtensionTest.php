<?php

namespace Nexy\SlackBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Nexy\SlackBundle\DependencyInjection\NexySlackExtension;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
class NexySlackExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage The child node "endpoint" at path "nexy_slack" must be configured.
     */
    public function testLoadWithNoConfiguration()
    {
        $this->load();
    }

    public function testLoadWithMinimalConfiguration()
    {
        $this->load([
            'endpoint' => 'https://hooks.slack.com/services/XXXXX/XXXXX/XXXXXXXXXX',
        ]);

        $this->assertContainerBuilderHasParameter('nexy_slack.endpoint', 'https://hooks.slack.com/services/XXXXX/XXXXX/XXXXXXXXXX');
        $this->assertContainerBuilderHasParameter('nexy_slack.config', [
            'channel' => null,
            'username' => null,
            'icon' => null,
            'link_names' => false,
            'unfurl_links' => false,
            'unfurl_media' => true,
            'allow_markdown' => true,
            'markdown_in_attachments' => [],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions()
    {
        return [
            new NexySlackExtension(),
        ];
    }
}
