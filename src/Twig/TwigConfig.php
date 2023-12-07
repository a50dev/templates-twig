<?php

declare(strict_types=1);

namespace A50\Templates\Twig;

final class TwigConfig
{
    private array $extensions;
    private string $frontendUrl;

    private function __construct(array $extensions, string $frontendUrl)
    {
        $this->extensions = $extensions;
        $this->frontendUrl = $frontendUrl;
    }

    public static function withDefaults(array $extensions = [], string $frontendUrl = ''): self
    {
        return new self($extensions, $frontendUrl);
    }

    /**
     * @param class-string $extensionClassName
     * @return $this
     */
    public function withExtension(string $extensionClassName): self
    {
        $new = clone $this;
        $new->extensions[] = $extensionClassName;

        return $new;
    }

    public function extensions(): array
    {
        return $this->extensions;
    }

    public function withFrontendUrl(string $frontendUrl): self
    {
        $new = clone $this;
        $new->frontendUrl = $frontendUrl;

        return $new;
    }

    public function frontendUrl(): string
    {
        return $this->frontendUrl;
    }
}
