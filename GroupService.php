<?php
class GroupService
{
    private GroupRepository $repo;

    /**
     * @param GroupRepository $repo
     */
    public function __construct(GroupRepository $repo)
    {
        $this->repo = $repo;
    }

    public function group_hierarchy(int $id): Group
    {
        $main_group = $this->repo->find_by_id($id);
        $group = $main_group;
        $prev_group = null;
        while ($group->id_parent != 0) {
            $this->set_children($group, $prev_group);
            $prev_group = $group;
            $group = $this->repo->find_by_id($group->id_parent);
        }
        $this->set_children($group, $prev_group);
        return $group;
    }
    private function set_children(?Group $group, ?Group $prev_group): void
    {
        $group->children = $this->repo->get_children_by_id($group->id);
        if (!is_null($prev_group)) {
            for ($i = 0; $i < count($group->children); $i++) {
                if ($group->children[$i]->id === $prev_group->id) {
                    $group->children[$i] = $prev_group;
                    break;
                }
            }
        }
    }
}
