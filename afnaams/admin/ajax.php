<?php
ob_start();
$action = $_GET['action'];
include 'my_class.php';
$crud = new Action();
if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}

if ($action == 'logout2') {
	$logout = $crud->logout2();
	if ($logout)
		echo $logout;
}
if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if ($action == 'saveNonAcademicAwards') {
	$save = $crud->saveNonAcademicAwards();
	if ($save)
		echo $save;
}
if ($action == 'approve_non_academic_awards') {
	$save = $crud->approve_non_academic_awards();
	if ($save)
		echo $save;
}
if ($action == 'delete_non_academic_awards') {
	$save = $crud->delete_non_academic_awards();
	if ($save)
		echo $save;
}
if ($action == 'update_account') {
	$save = $crud->update_account();
	if ($save)
		echo $save;

}
if ($action == "update_student_acc") {
	$save = $crud->update_student_acc();
	if ($save)
		echo $save;
}
if ($action == "unarchive_non_academic_awards") {
	$save = $crud->unarchive_non_academic_awards();
	if ($save)
		echo $save;
}
ob_end_flush();

?>