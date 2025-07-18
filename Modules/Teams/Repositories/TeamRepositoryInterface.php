<?php

namespace Modules\Teams\Repositories;

interface TeamRepositoryInterface
{
    public function allForTenant(int $tenantId);
    public function findForTenant(int $tenantId, int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
