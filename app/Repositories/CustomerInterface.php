<?php

namespace App\Repositories;

interface CustomerInterface{
    public function getAll();
    public function getOne(Int $id);
    public function store(Array $data);
    public function update(Int $id, Array $data);
    public function destroy(Int $id);
}