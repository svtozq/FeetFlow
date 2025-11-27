<?php
namespace App\Actions\Organization;

use App\DTOs\OrganizationDTO;
use App\Events\SurveyAnswerSubmitted;
use App\Models\Organization;
use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\DB;

final class StoreOrganizationAction
{
    public function __construct() {}

    /**
     * Store an organization
     * @param OrganizationDTO $dto
     * @return array
     */
    public function handle(OrganizationDTO $dto): Organization
    {
        //Create a new organization in to database
        $organization = DB::transaction(function () use ($dto) {
            $org = Organization::create([
                'name' => $dto->name,
                'user_id' => $dto->user_id,
            ]);

            // Add information into relation Organization and Organization_user
            $org->members()->attach($dto->user_id, [
                'role' => 'admin',
            ]);

            return $org;
        });

        $organization->load('members');
        return $organization;
    }

}
