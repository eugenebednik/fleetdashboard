<?php

namespace App\Http\Livewire\AllowedRoles;

use App\Models\AllowedRole;
use App\Services\DiscordService;
use Livewire\Component;

class AllowedRoles extends Component
{
    public $allowedRoles;
    public $discordRoles;

    public function mount(DiscordService $discordService)
    {
        $this->discordRoles = $discordService->getGuildRoles();
    }

    public function render()
    {
        return view('allowed-roles.show');
    }

    public function addOrRemove($roleId, $roleName)
    {
        $role = AllowedRole::where('role_id', $roleId)->first();

        if (!$role) {
            AllowedRole::create([
                'role_id' => $roleId,
                'role_name' => $roleName,
            ]);
        } else {
            $role->delete();
        }
    }

    public function dashboard()
    {
        $this->redirect(route('admin.index'));
    }
}
