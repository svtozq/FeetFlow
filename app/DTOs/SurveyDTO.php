<?php

namespace App\DTOs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use InvalidArgumentException;

class SurveyDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $token,
        public Carbon $start_date,
        public Carbon $end_date,
        public readonly bool $closed,
        public int $organization_id,
        public readonly bool $is_anonymous,
    ) {}

    public static function fromRequest($request,  int $organizationId): self
    {
        return new self(
            title: $request->title,
            description: $request->description,
            token: Str::random(32),
            start_date: Carbon::parse($request->start_date)->startOfDay(),
            end_date: Carbon::parse($request->end_date)->endOfDay(),
            closed: (bool) $request->closed,
            organization_id: $organizationId,
            is_anonymous: (bool) $request->is_anonymous
        );
    }
}
