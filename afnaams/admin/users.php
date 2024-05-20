<?php include 'db_connect.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$importError = false;
$importStatus = '';

if (isset($_POST['importSubmit'])) {
	$excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

	if (!empty($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $excelMimes)) {
		if (is_uploaded_file($_FILES['excel_file']['tmp_name'])) {
			$reader = new Xlsx();
			$spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
			$worksheet = $spreadsheet->getActiveSheet();
			$worksheet_arr = $worksheet->toArray();
			unset($worksheet_arr[0]);

			// Flag to track whether any username already exists
			$userExists = false;

			foreach ($worksheet_arr as $row) {
				// Skip empty rows
				if (empty(array_filter($row))) {
					continue;
				}

				$nameParts = explode(' ', $row[0]);
				$firstname = $nameParts[0];
				$lastname = implode(' ', array_slice($nameParts, 1));
				$username = $row[1];
				$password = md5($row[2]);
				$type = 2;

				// Check if either username already exists
				$chk = $conn->query("SELECT id FROM users WHERE username = '$username'")->num_rows;

				if ($chk > 0) {
					// At least one username already exists, set import error flag and status
					$userExists = true;
					$importStatus .= '<span style="color: red;">Import failed: username already exists - ' . $username . '</span><br>';
					// Break out of the loop since at least one username already exists
					break;
				}
			}

			if (!$userExists) {
				// None of the usernames exist, proceed with insertions
				foreach ($worksheet_arr as $row) {
					// Skip empty rows
					if (empty(array_filter($row))) {
						continue;
					}

					$nameParts = explode(' ', $row[0]);
					$firstname = $nameParts[0];
					$lastname = implode(' ', array_slice($nameParts, 1));
					$username = $row[1];
					$password = md5($row[2]);
					$type = 2;

					// Proceed with insertion
					$conn->query("INSERT INTO users (name, username, password, type) VALUES ('$row[0]', '$username', '$password', $type)");
					$userId = $conn->insert_id;
					$conn->query("INSERT INTO students (firstname, lastname, email, status) VALUES ('$firstname', '$lastname', '$username', 1)");
					$studentsId = $conn->insert_id;
					$conn->query("UPDATE users SET students_id = $studentsId WHERE id = $userId");
				}

				$_SESSION['importStatus'] = 'Data Successfully Imported';
				echo '<script>window.location.href = "index.php?page=list_students";</script>';
				exit();
			}
		} else {
			$importStatus = '<span style="color: red;">Error uploading file</span>';
		}
	} else {
		$importStatus = '<span style="color: red;">Invalid file format</span>';
	}
}

?>
<title>Import Students</title>
<div class="container-fluid">

	<div class="row">
		<div class="card col-lg-12">
			<form action="" id="importForm" method="POST" enctype="multipart/form-data">
				<div class="row form-group">
					<div class="col-md-4 mt-2">
						<h4>Import Students account</h4>
						<small class="text-danger"><b><i>Please note that only only Excel files (.xls, .xlsx) and data
									including
									name,
									username, and
									password can be imported</i></b></small>
						<input type="file" class="form-control" name="excel_file" accept=".xls, .xlsx">
						<button type="submit" class="btn btn-md btn-primary mt-2" name="importSubmit">Import</button>
					</div>
				</div>
			</form>
			<?php
			if (isset($importStatus)) {
				echo "<p>{$importStatus}</p>";
			}
			?>

		</div>
	</div>

</div>
<script>
	$('#new_user').click(function () {
		uni_modal('New User', 'manage_user.php')
	})
	$('.edit_user').click(function () {
		uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
	})
	$('.delete_user').click(function () {
		var id = $(this).attr('data-id');
		_conf("Are you sure to delete this user?", "delete_user", [id]);
	})

	function delete_user(id) {
		start_load();
		$.ajax({
			url: 'ajax.php?action=delete_user',
			method: 'POST',
			data: {
				id: id
			},
			success: function (resp) {
				if (resp == 1) {
					alert_toast("Data successfully deleted", 'success');
					setTimeout(function () {
						location.reload();
					}, 1500);
				} else {
					// Display the error message in red
					alert_toast(resp, 'error', 'red');
					end_load();
				}
			}
		});
	}
</script>