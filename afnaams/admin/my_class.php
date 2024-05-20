<?php
session_start();
ini_set('display_errors', 1);

class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{

		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if ($_SESSION['login_type'] != 1) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2;
				exit;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function login2()
	{
		extract($_POST);
		if (isset($email))
			$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			if ($_SESSION['login_students_id'] > 0) {
				$bio = $this->db->query("SELECT * FROM students where id = " . $_SESSION['login_students_id']);
				if ($bio->num_rows > 0) {
					foreach ($bio->fetch_array() as $key => $value) {
						if ($key != 'password' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if ($_SESSION['bio']['status'] != 1) {
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				return 2;
				exit;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2()
	{
		// Clear session data
		session_unset();
		session_destroy();

		header("location:../index.php");
	}
	function save_user()
	{
		extract($_POST);

		$type = isset($type) ? $type : 1; // Set a default value for $type


		// Check if the provided username already exists for a different user
		$chk = $this->db->query("SELECT * FROM users WHERE username = '$username' AND id != '$id'")->num_rows;

		if ($chk > 0) {
			return 2; // Username already exists for another user
		}

		$data = "name = '$name', username = '$username'";

		// Check if a new password is provided, and hash it
		if (!empty($password)) {
			$data .= ", password = '" . md5($password) . "'";
		}

		$data .= ", type = '$type'";

		if (empty($id)) {
			// Insert a new user record
			$save = $this->db->query("INSERT INTO users SET " . $data);
		} else {
			// Update an existing user record
			$save = $this->db->query("UPDATE users SET " . $data . " WHERE id = " . $id);
		}

		if ($save) {
			return 1; // Success
		} else {
			// Log and return the SQL error message
			$error_message = $this->db->error;
			error_log("SQL Error: $error_message"); // Log the error
			return 0; // Database error
		}
	}



	function delete_user()
	{
		extract($_POST);

		// Check if the ID is set in the POST data
		if (!isset($_POST['id'])) {
			return '<span style="color: red;">No user ID provided</span>';
		}

		// Extract the ID from the POST data
		$id = $_POST['id'];

		// Check if the ID is valid
		if (!is_numeric($id)) {
			return '<span style="color: red;">Invalid user ID</span>';
		}

		// Check the user type before deletion
		$user = $this->db->query("SELECT type, students_id FROM users WHERE id = " . $id)->fetch_assoc();

		// Debugging: Check the value of the user variable
		var_dump($user);

		// Check if the user exists
		if (!$user) {
			return '<span style="color: red;">User not found</span>';
		}

		// Check the user type before deletion
		$user = $this->db->query("SELECT type, students_id FROM users WHERE id = " . $id)->fetch_assoc();

		// Check if the user exists
		if (!$user) {
			return '<span style="color: red;">User not found</span>';
		} else {
			// If the user has associated students_id, get the avatar filename from students
			$avatarFilename = '';
			if (!empty($user['students_id'])) {
				$avatarFilename = $this->db->query("SELECT avatar FROM students WHERE id = " . $user['students_id'])->fetch_assoc()['avatar'];
			}

			// Delete the user record
			$deleteUser = $this->db->query("DELETE FROM users WHERE id = " . $id);

			if ($deleteUser) {
				// If the user has associated students_id, delete the corresponding record in students
				if (!empty($user['students_id'])) {
					$deleteStudents = $this->db->query("DELETE FROM students WHERE id = " . $user['students_id']);
					if (!$deleteStudents) {
						// Handle any errors in deleting students record
						return '<span style="color: red;">Error deleting associated students record</span>';
					}
				}

				// If an avatar is associated with the user, delete the corresponding file
				if (!empty($avatarFilename)) {
					$avatarPath = $_SERVER['DOCUMENT_ROOT'] . '/afnaams/admin/assets/uploads/' . $avatarFilename;
					if (file_exists($avatarPath)) {
						unlink($avatarPath);
					}
				}

				return 1; // Deletion successful
			} else {
				// Handle any errors in deleting user record
				return '<span style="color: red;">Error deleting user record</span>';
			}
		}
	}



	function saveNonAcademicAwards()
	{
		extract($_POST);

		if (empty($first_name) || empty($last_name) || empty($department) || empty($program) || empty($gender)) {
			return "Please fill in all required fields.";
		}

		// Handle file upload
		$attachment = null;
		if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
			$target_dir = "attachment_uploads/";
			$attachment = basename($_FILES['attachment']['name']);
			$target_file = $target_dir . $attachment;
			if (!move_uploaded_file($_FILES['attachment']['tmp_name'], $target_file)) {
				return "Error uploading file.";
			}
		}

		// Prepare data
		$data = [
			'last_name' => $last_name,
			'first_name' => $first_name,
			'middle_name' => isset($middle_name) ? $middle_name : null,
			'department' => $department,
			'program' => $program,
			'complete_address' => isset($complete_address) ? $complete_address : null,
			'gender' => $gender,
			'campus_service_award' => isset($campus_service_award) ? $campus_service_award : null,
			'department_service_award' => isset($department_service_award) ? $department_service_award : null,
			'community_service_award' => isset($community_service_award) ? $community_service_award : null,
			'accomplishments' => isset($accomplishments) ? $accomplishments : null,
			'organized_by' => isset($organized_by) ? $organized_by : null,
			'inclusive_dates' => isset($inclusive_dates) ? $inclusive_dates : null,
			'venue' => isset($venue) ? $venue : null,
			'campus_ministry_award' => isset($campus_ministry_award) ? $campus_ministry_award : null,
			'what_ministry' => isset($what_ministry) ? $what_ministry : null,
			'inclusive_years_ministry' => isset($inclusive_years_ministry) ? $inclusive_years_ministry : null,
			'campus_leadership_award' => isset($campus_leadership_award) ? $campus_leadership_award : null,
			'department_leadership_award' => isset($department_leadership_award) ? $department_leadership_award : null,
			'community_leadership_award' => isset($community_leadership_award) ? $community_leadership_award : null,
			'position' => isset($position) ? $position : null,
			'organization' => isset($organization) ? $organization : null,
			'inclusive_years_organization' => isset($inclusive_years_organization) ? $inclusive_years_organization : null,
			'campus_ministry_leadership_award' => isset($campus_ministry_leadership_award) ? $campus_ministry_leadership_award : null,
			'what_ministry_leadership' => isset($what_ministry_leadership) ? $what_ministry_leadership : null,
			'position_ministry_leadership' => isset($position_ministry_leadership) ? $position_ministry_leadership : null,
			'inclusive_years_ministry_leadership' => isset($inclusive_years_ministry_leadership) ? $inclusive_years_ministry_leadership : null,
			'graphic_arts_award' => isset($graphic_arts_award) ? $graphic_arts_award : null,
			'performing_arts_award' => isset($performing_arts_award) ? $performing_arts_award : null,
			'cultural_accomplishments' => isset($cultural_accomplishments) ? $cultural_accomplishments : null,
			'cultural_organized_by' => isset($cultural_organized_by) ? $cultural_organized_by : null,
			'cultural_inclusive_dates' => isset($cultural_inclusive_dates) ? $cultural_inclusive_dates : null,
			'cultural_venue' => isset($cultural_venue) ? $cultural_venue : null,
			'attachment' => $attachment,
			'clarify' => isset($_POST['clarify']) ? $_POST['clarify'] : 'Disagree'
		];

		// Build query
		$query = "INSERT INTO non_academic_awards SET ";
		foreach ($data as $key => $value) {
			if (!is_null($value)) {
				$query .= "$key = '$value', ";
			}
		}
		// Remove the trailing comma and space
		$query = rtrim($query, ', ');

		// Execute the query
		$result = $this->db->query($query);

		// Check if insertion was successful
		if ($result) {
			return "You have successfully submitted your non-academic awards data.";
		} else {
			return "Error saving non-academic awards data.";
		}
	}


	function approve_non_academic_awards()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE non_academic_awards set status = $status where id = $id");
		if ($update)
			return 1;
	}

	function delete_non_academic_awards()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE non_academic_awards SET archive = 1 WHERE id = $id");
		if ($archive)
			return 1;
	}
	function unarchive_non_academic_awards()
	{
		extract($_POST);
		$archive = $this->db->query("UPDATE non_academic_awards SET archive = 0 WHERE id = $id");
		if ($archive)
			return 1;
	}




	function update_account()
	{
		extract($_POST);

		// Construct the data for update
		$data = " name = '" . $firstname . ' ' . $lastname . "' ";
		$data .= ", username = '$email' ";
		if (!empty($password))
			$data .= ", password = '" . md5($password) . "' ";

		// Update the user data
		$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if ($save) {
			// Construct the data for updating student details
			$student_data = '';
			foreach ($_POST as $k => $v) {
				if ($k == 'password')
					continue;
				if (empty($student_data) && !is_numeric($k))
					$student_data = " $k = '$v' ";
				else
					$student_data .= ", $k = '$v' ";
			}

			// Upload avatar if provided
			if ($_FILES['img']['tmp_name'] != '') {
				$fname = $_FILES['img']['name'];
				// Remove existing avatar
				$existingAvatar = $this->db->query("SELECT avatar FROM students WHERE id = '{$_SESSION['bio']['id']}'")->fetch_assoc();
				$existingAvatarPath = 'assets/uploads/' . $existingAvatar['avatar'];
				if (file_exists($existingAvatarPath)) {
					unlink($existingAvatarPath);
				}
				$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
				$student_data .= ", avatar = '$fname' ";
			}

			// Update student details
			$save_student = $this->db->query("UPDATE students set $student_data where id = '{$_SESSION['bio']['id']}' ");
			if ($save_student) {
				// Clear session data
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				// Re-login
				$login = $this->login2();
				if ($login)
					return 1; // Return success code 1
			}
		}
	}
	function update_student_acc()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE students set status = $status where id = $id");
		if ($update)
			return 1;
	}

}
