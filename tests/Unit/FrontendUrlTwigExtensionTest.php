<?php

declare(strict_types=1);

namespace A50\Templates\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use A50\Templates\Twig\Extensions\Frontend\FrontendUrlGenerator;
use A50\Templates\Twig\Extensions\Frontend\FrontendUrlTwigExtension;

/**
 * @covers \A50\Templates\Twig\Extensions\Frontend\FrontendUrlTwigExtension
 *
 * @internal
 */
final class FrontendUrlTwigExtensionTest extends TestCase
{
    public function testSuccess(): void
    {
        $frontend = $this->createMock(FrontendUrlGenerator::class);
        $frontend->expects(self::once())->method('generate')->with(
            self::equalTo('path'),
            self::equalTo(['a' => 1, 'b' => 2])
        )->willReturn('http://test/path?a=1&b=2');

        $twig = new Environment(new ArrayLoader([
            'page.html.twig' => '<p>{{ frontend_url(\'path\', {\'a\': 1, \'b\': 2}) }}</p>',
        ]));

        $twig->addExtension(new FrontendUrlTwigExtension($frontend));

        self::assertEquals('<p>http://test/path?a=1&amp;b=2</p>', $twig->render('page.html.twig'));
    }
}
