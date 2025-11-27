<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;

final class DeleteOrganizationAction
{
    public function __construct()
    {
    }

    /**
     * Delete an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): array
    {
        return DB::transaction(function () use ($dto) {
            $organization = Organization::findOrFail($dto->organization_id);

            foreach ($organization->surveys as $survey) {
                // delete questions of survey
                $survey->questions()->delete();

                // delete survey
                $survey->delete();
            }

            $organization->members()->detach();
            $organization->delete();

            return [
                'message' => 'Organisation supprimée avec succès',
                'organization_id' => $dto->organization_id,
            ];
        });
    }
}

