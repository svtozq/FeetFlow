<?php

namespace App\DTOs;

use InvalidArgumentException;

class SurveyDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public Carbon $start_date,
        public Carbon $end_date,
        public readonly bool $is_anonymous,
    ) {}

    public static function fromRequest($request): self
    {
        $organizationId = session('current_organization_id');

        if (!$organizationId) {
            throw new InvalidArgumentException('Organisation courante non définie en session.');
        }

        return new self(
//            organization_id: (int)$organizationId,
//            user_id: $request->user()->id,
            title: $request->title,
            description: $request->description,
            start_date: $request->start_date,
            end_date: $request->end_date,
            is_anonymous: (bool) ($request->is_anonymous ?? false),
        );
    }
}
