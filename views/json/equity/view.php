<?php
$array = $equity->as_array('id', 'parent_id', 'name', 'description');
$array['children'] = array();
foreach ($equity->children->find_all() as $child)
{
	$array['children'][] = $child->as_array('id', 'name', 'description');
}
$array['balance'] = $equity->balance();
echo json_encode($array);
?>
