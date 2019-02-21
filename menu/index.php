<?php
////tegelikult peavad olema conf.php failis
define('BASE_DIR', './'); // define('BASE_DIR', '../');
require_once(BASE_DIR.'conf.php');
//
/*echo '<pre>';
print_r($sess);
echo '</pre>';*/
$mainTmpl = new Template('main');
$mainTmpl->set('title', 'Menu Application');
$contentTmpl = new Template('content');
$courseCardTmpl = new Template('course_card');
$courseCardHeaderTmpl = new Template('course_card_header.html');
$courseCardDataTmpl = new Template('course_card_data');
$courseDatalistTmpl = new Template('course_data_list');

$courses = array(
    array(
        'name' => 'praed',
        'icon' => 'fa-utensils',
        'data' => array(
            array(
                'dish_name' => 'Sealihapada ploomide ja aprikoosiga',
                'dish_description' => 'sealihapada, lisand, salat, leib',
                'dish_price' => 2.65,
                'discount' => 2.25
            ),
            array(
                'dish_name' => 'Praetud kanakints',
                'dish_description' => 'praetud kana, lisand, salat, leib',
                'dish_price' => 2.50,
                'discount' => 2.13
            )
        )
    ),
    array(
        'name' => 'supid',
        'icon' => 'fa-utensil-spoon',
        'data' => array(
            array(
                'dish_name' => 'Rassolnik',
                'dish_description' => 'supp, hapukoor, leib',
                'dish_price' => 1.10,
                'discount' => 0.94
            )
        )
    )
);
foreach ($courses as $course => $courseData){
    $courseCardHeaderTmpl->set('course_name', $courseData['name']);
    $courseCardHeaderTmpl->set('course_icon', $courseData['icon']);
    $courseCardTmpl->set('course_card_header', $courseCardHeaderTmpl->parse());

    $courseCardDataTmpl->set('course_name', $courseData['name']);

    $courseDatalistTmpl = new Template('course_data_list');
    foreach ($courseData['data'] as $dish => $dishData) {
        $courseDatalistTmpl->set('dish_name', $dishData['dish_name']);
        $courseDatalistTmpl->set('dish_description', $dishData['dish_description']);
        $courseDatalistTmpl->set('dish_price', $dishData['dish_price']);
        $courseDatalistTmpl->set('discount', $dishData['discount']);
        $courseCardDataTmpl->add('course_data_list', $courseDatalistTmpl->parse());
    }
    $courseCardTmpl->set('course_card_data', $courseCardDataTmpl->parse());

    $contentTmpl->add('course_cards', $courseCardTmpl->parse());
}
$mainTmpl->set('content', $contentTmpl->parse());
$mainTmplContent = $mainTmpl->parse();
echo $mainTmplContent;