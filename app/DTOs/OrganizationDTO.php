<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class OrganizationDTO
{
    private function __construct(
        public readonly ?string $name = null,
        public readonly int $user_id,
        public readonly ?int $organization_id = null,
        public readonly array $members,
) {}

    public static function fromRequest(Request $request, ?int $organizationId = null): self
    {
        return new self(
            name: $request->name,
            user_id: $request->user()->id,
            organization_id: $organizationId ?? $request->route('organization')?->id,
            members: $request->members ?? [],
        );
    }

    public static function fromId(int $organizationId, Request $request): self
    {
        return new self(
            name: null,
            user_id: $request->user()->id,
            organization_id: $organizationId,
            members: $request->members ?? [],
        );
    }
}
