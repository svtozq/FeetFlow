<?php

namespace App\Http\Controllers;

use App\Actions\Organization\DeleteOrganizationAction;
use App\Actions\Organization\UpdateOrganizationAction;
use App\DTOs\OrganizationDTO;
use App\Http\Requests\Organization\DeleteOrganization;
use App\Http\Requests\Organization\StoreOrganization;
use App\Http\Requests\Organization\UpdateOrganization;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public function index() {
        // get user as login
        $user = auth()->user();

        // get theirs organizations with the relation OrganizationUser
        $memberships = OrganizationUser::where('user_id', $user->id)->get();
        $organizations = $memberships->map(fn($m) => $m->organization->load('members'));


        return view('organizationPage', compact('organizations'));
    }


    public function createOrganization(StoreOrganization $request): RedirectResponse
    {
        $organizationDTO = OrganizationDTO::fromRequest($request);

        $organization = Organization::create([
            'name' => $organizationDTO->name,
            'user_id' => $organizationDTO->user_id,
        ]);

        // Add user like admin with relation
        $organization->members()->create([
            'user_id' => auth()->user()->id,
            'role' => 'admin',
        ]);

        // load people for the answer
        $organization->load('members');

        return redirect()->route('organizations.index')
            ->with('success', 'Organisation créée avec succès !');
    }

    public function updateOrganization(UpdateOrganization $request, Organization $organization)
    {
        $dto = OrganizationDTO::fromRequest($request, $organization->id);

        (new UpdateOrganizationAction())->handle($dto);

        // Redirection
        return redirect()
            ->route('organizations.index')
            ->with('success', 'Organisation mise à jour avec succès !');
    }

    public function editOrganization(Organization $organization)
    {
        $organization->load('members');

        $users = User::all();

        return view('organizationEditPage', compact('organization', 'users'));

    }



    public function deleteOrganization(DeleteOrganization $request, Organization $organization)
    {
        $dto = OrganizationDTO::fromId( $organization->id, $request);
        $result = (new DeleteOrganizationAction())->handle($dto);

        return redirect()->route('organizations.index')
            ->with('success', $result['message']);
    }

}
