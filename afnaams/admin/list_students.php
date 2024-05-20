<?php include ('db_connect.php'); ?>
<title>Students List</title>
<style>
	.filter-wrapper {
		margin-top: 20px;
		margin-left: 20px;
	}

	.filter-wrapper .checkBox {
		margin-right: 10px;
	}
</style>

<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-lg-12">

			<!-- Table Panel -->
			<div class="card">
				<div class="card-header">
					<b>List of Students</b>
				</div>
				<div class="card-body table-responsive">
					<table id="myTable" class="table table-bordered table-sm table-striped nowrap compact">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Profile</th>
								<th class="text-center">Last Name</th>
								<th class="text-center">First Name</th>
								<th class="text-center">Middle Name</th>
								<th class="text-center">Gender</th>
								<th class="text-center">Birthdate</th>
								<th class="text-center">Age</th>
								<th class="text-center">Address</th>
								<th class="text-center">Email Address</th>
								<th class="text-center">Address</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$archived = isset($_GET['archived']) ? $_GET['archived'] : 0;
							$showArchived = $archived ? 'a.archived = 1' : 'a.archived = 0';

							$students = $conn->query("SELECT 
    a.id,
    a.firstname,
    a.middlename,
    a.lastname,
    a.gender,
    a.email,
    a.avatar,
    a.birthday,
    a.age,
    a.address
FROM students a
WHERE a.status = 1
ORDER BY a.id ASC");

							while ($row = $students->fetch_assoc()): ?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<div class="img-container">
											<img src="assets/uploads/<?php echo $row['avatar'] ?>" class="" alt="">
										</div>
									</td>
									<td class="text-center"><?php echo ucwords($row['lastname']) ?></td>
									<td class="text-center"><?php echo ucwords($row['firstname']) ?></td>
									<td class="text-center"><?php echo ucwords($row['middlename']) ?></td>
									<td class="text-center"><?php echo $row['gender'] ?></td>
									<td class="text-center"><?php echo $row['birthday'] ?></td>
									<td class="text-center"><?php echo $row['age'] ?></td>
									<td class="text-center"><?php echo $row['address'] ?></td>
									<td class="text-center"><?php echo $row['email'] ?></td>
									<td class="text-center"><?php echo $row['address'] ?></td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- End Table Panel -->

		</div>
	</div>
</div>

<script>
</script>