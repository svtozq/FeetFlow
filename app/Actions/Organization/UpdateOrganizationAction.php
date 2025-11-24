<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

final class UpdateOrganizationAction
{
    /**
     * Update an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {

            // get the organisation
            $organization = Organization::findOrFail($dto->organization_id);

            // Update
            $organization->update([
                'name' => $dto->name,
            ]);

            $organization->members()->sync($dto->members);
            return [
                'success' => true,
                'organization' => $organization->load('members'),
            ];
        });
    }
}
