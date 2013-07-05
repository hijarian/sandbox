<?php
$item = array();
$item['course_id'] = 1;
$actions = array(
    'EDIT'   => sprintf('<a href="admin-ajax.php?action=%s&subaction=%s&course_id=%d" class="%s" id="%s">Edit</a>',
                    'abf_cm',
                    'edit_course',
                    $item['course_id'],
                    'thickbox edit-box',
                    'edit_'.$item['course_id']
                    ),
    'DELETE'    => sprintf('<a href="?page=%s&task=%s&action=%s&bookid=%s&noheader=true">Delete</a>','course_management','do_process','delete',$item['course_id']),
);

print_r($actions);
