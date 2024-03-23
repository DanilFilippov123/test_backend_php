<?php

class Group {
    public int $id;
    public int $id_parent;
    public string $name;

    public ?array $children = null;

    public ?int $product_count;

    public function __construct(int $id, int $id_parent, string $name)
    {
        $this->id = $id;
        $this->id_parent = $id_parent;
        $this->name = $name;
    }
}
