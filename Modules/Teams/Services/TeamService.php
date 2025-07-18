<?php

namespace Modules\Teams\Services;

use Modules\Teams\Repositories\TeamRepositoryInterface;

class TeamService
{
    protected $teams;

    public function __construct(TeamRepositoryInterface $teams)
    {
        $this->teams = $teams;
    }

    public function listTeamsForTenant(int $tenantId)
    {
        return $this->teams->allForTenant($tenantId);
    }

    public function createTeam(array $data)
    {
        return $this->teams->create($data);
    }

    public function updateTeam(int $id, array $data)
    {
        return $this->teams->update($id, $data);
    }

    public function deleteTeam(int $id)
    {
        return $this->teams->delete($id);
    }

    public function findForTenant(int $tenantId, int $id)
    {
        return $this->teams->findForTenant($tenantId, $id);
    }
}
