<?php
$id = new PuzzleField;
$id->set_name(__('Section Slug', 'puzzle-page-builder'))
    ->set_id('id')
    ->set_tip(__('<strong>Use this for linking directly to a section. Lowercase letters, numbers, dashes, and underscores only.</strong> If left blank, the section slug will be the headline lowercase with words separated by dashes (symbols will be deleted). If both the section slug and headline are blank, the section slug will be "section-n" where "n" is the place that the section is in on the page (e.g. the 4th section on the page will be "section-4").', 'puzzle-page-builder'));

$f->add_field($id);
?>
