<?php
namespace Modules\Payments\Contracts;

use Modules\Payments\Entities\Refund;

interface RefundRepositoryContract
{
    public function getAll();
    public function create($data,$id);
    public function getById($id);
}