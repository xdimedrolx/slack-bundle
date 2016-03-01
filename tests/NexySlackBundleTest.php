<?php

namespace Nexy\SlackBundle\Tests;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;
use Nexy\SlackBundle\NexySlackBundle;

/**
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
class NexySlackBundleTest extends AbstractContainerBuilderTestCase
{
    /**
     * @var NexyIsoCodesValidatorBundle
     */
    protected $bundle;

    protected function setUp()
    {
        parent::setUp();

        $this->bundle = new NexySlackBundle();
    }

    public function testBuild()
    {
        $this->bundle->build($this->container);
    }
}
