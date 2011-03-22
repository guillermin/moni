<?php
$array = $drain->as_array('id', 'parent_id', 'name', 'description');
$array['children'] = array();
foreach ($drain->children->find_all() as $child)
{
	$array['children'][] = $child->as_array('id', 'name', 'description');
}
echo json_encode($array);
?>
