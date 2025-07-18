<?php

namespace Modules\Teams\Repositories;

use Modules\Teams\Models\Team;

class TeamRepository implements TeamRepositoryInterface
{
    public function allForTenant(int $tenantId)
    {
        return Team::forTenant($tenantId)->get();
    }

    public function findForTenant(int $tenantId, int $id)
    {
        return Team::forTenant($tenantId)->findOrFail($id);
    }

    public function create(array $data)
    {
        return Team::create($data);
    }

    public function update(int $id, array $data)
    {
        $team = Team::findOrFail($id);
        $team->update($data);
        return $team;
    }

    public function delete(int $id)
    {
        $team = Team::findOrFail($id);
        return $team->delete();
    }
}
