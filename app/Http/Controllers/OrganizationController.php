<?php

namespace App\Http\Controllers;

use App\Actions\Organization\DeleteOrganizationAction;
use App\Actions\Organization\StoreOrganizationAction;
use App\Actions\Organization\UpdateOrganizationAction;
use App\DTOs\OrganizationDTO;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\Organization\DeleteOrganization;
use App\Http\Requests\Organization\StoreOrganization;
use App\Http\Requests\Organization\UpdateOrganization;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\SurveyAnswer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // take user connected
        $user = auth()->user();

        //take Organization where user are member
        $organizations = Organization::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->with(['members' => function($q) {
                $q->select('users.id', 'users.first_name', 'users.last_name');
            }])
            ->get();

        return view('Organization.organizationPage', compact('organizations'));
    }


    /**
     * @param StoreOrganization $request
     * @return RedirectResponse
     */
    public function createOrganization(StoreOrganization $request): RedirectResponse
    {
        //Take data of Dto
        $organizationDTO = OrganizationDTO::fromRequest($request);

        //Call action
        (new StoreOrganizationAction())->handle($organizationDTO);

        return redirect()
            ->route('organizations.index')
            ->with('success', 'Organisation créée avec succès !');
    }

    /**
     * @param UpdateOrganization $request
     * @param Organization $organization
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateOrganization(UpdateOrganization $request, Organization $organization)
    {
        // authorization of who can make action
        $this->authorize('update', $organization);
        $dto = OrganizationDTO::fromRequest($request, $organization->id);

        (new UpdateOrganizationAction())->handle($dto);

        // Redirection
        return redirect()
            ->route('organizations.index')
            ->with('success', 'Organisation mise à jour avec succès !');
    }

    /**
     * @param Organization $organization
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function editOrganization(Organization $organization)
    {
        $this->authorize('update', $organization);
        $organization->load('members');

        $users = User::all();

        return view('Organization.organizationEditPage', compact('organization', 'users'));

    }


    /**
     * @param DeleteOrganization $request
     * @param Organization $organization
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */

    public function deleteOrganization(DeleteOrganization $request, Organization $organization)
    {
        $this->authorize('delete', $organization);
        $dto = OrganizationDTO::fromId( $organization->id, $request);
        $result = (new DeleteOrganizationAction())->handle($dto);

        return redirect()->route('organizations.index')
            ->with('success', $result['message']);
    }

}
