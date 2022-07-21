<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

interface ResourcesInterface
{
    public function rules(): array;
    public function store(array $data): Model;
    public function update(string $id, array $data): Model;
    public function get(string $id): Model;
    public function delete(string $id): void;
}