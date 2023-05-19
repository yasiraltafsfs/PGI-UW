<?php
namespace Modules\Payments\Contracts;

use Modules\Payments\Entities\Transaction;

interface TransactionContract
{
    public function getAll();
    public function create($data);
    public function update(Transaction $transaction,$data);
    public function getById($id);
    public function getDefaultMethod();
}