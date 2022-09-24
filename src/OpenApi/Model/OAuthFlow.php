<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\OpenApi\Model;

final class OAuthFlow
{
    use ExtensionTrait;

    public function __construct(
        private ?string $authorizationUrl = null,
        private ?string $tokenUrl = null,
        private ?string $refreshUrl = null,
        private ?\ArrayObject $scopes = null,
    ) {}

    public function getAuthorizationUrl(): ?string
    {
        return $this->authorizationUrl;
    }

    public function getTokenUrl(): ?string
    {
        return $this->tokenUrl;
    }

    public function getRefreshUrl(): ?string
    {
        return $this->refreshUrl;
    }

    public function getScopes(): \ArrayObject
    {
        return $this->scopes;
    }

    public function withAuthorizationUrl(string $authorizationUrl): self
    {
        $clone = clone $this;
        $clone->authorizationUrl = $authorizationUrl;

        return $clone;
    }

    public function withTokenUrl(string $tokenUrl): self
    {
        $clone = clone $this;
        $clone->tokenUrl = $tokenUrl;

        return $clone;
    }

    public function withRefreshUrl(string $refreshUrl): self
    {
        $clone = clone $this;
        $clone->refreshUrl = $refreshUrl;

        return $clone;
    }

    public function withScopes(\ArrayObject $scopes): self
    {
        $clone = clone $this;
        $clone->scopes = $scopes;

        return $clone;
    }
}
