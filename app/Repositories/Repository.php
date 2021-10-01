<?php

namespace App\Repositories;

use PhpParser\Node\Expr\Cast\Bool_;

class Repository implements RepositoryInterface
{
    protected $items = [];
    protected $error = false;

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): Repository
    {
        $this->items = $items;

        return $this;
    }

    public function setError(Bool $error): Repository
    {
        $this->error = $error;

        return $this;
    }

    public function hasError(): Bool
    {
        return $this->error;
    }
}
