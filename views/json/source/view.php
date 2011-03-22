<?php
$array = $source->as_array('id', 'parent_id', 'name', 'description');
$array['children'] = array();
foreach ($source->children->find_all() as $child)
{
	$array['children'][] = $child->as_array('id', 'name', 'description');
}
echo json_encode($array);
?>
