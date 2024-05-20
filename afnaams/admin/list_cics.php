<?php include ('db_connect.php'); ?>
<title>All Non-Academic Awards CICS</title>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <!-- Table Panel -->
            <div class="card">
                <div class="card-header">
                    <b>All Non-Academic Awards CICS </b>
                </div>
                <div class="card-body table-responsive">
                    <table id="myTable" class="table table-bordered table-sm table-striped nowrap compact">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Middle Name</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Program</th>
                                <th class="text-center">Complete Address</th>
                                <th class="text-center">Gender</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            $non_academic_awards = $conn->query("SELECT * FROM non_academic_awards WHERE status = '1'AND department = 'CICS' ORDER BY id ASC");
                            while ($row = $non_academic_awards->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center"><?php echo $row['last_name'] ?></td>
                                    <td class="text-center"><?php echo $row['first_name'] ?></td>
                                    <td class="text-center"><?php echo $row['middle_name'] ?></td>
                                    <td class="text-center"><?php echo $row['department'] ?></td>
                                    <td class="text-center"><?php echo $row['program'] ?></td>
                                    <td class="text-center"><?php echo $row['complete_address'] ?></td>
                                    <td class="text-center"><?php echo $row['gender'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-danger delete" data-id="<?php echo $row['id'] ?>"
                                            type="button">Delete</button>

                                    </td>
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
    $('.delete').click(function () {
        var awardId = $(this).data('id');
        _conf("Are you sure to delete this non-academic award?", "delete_non_academic_award", [awardId]);
    });

    function delete_non_academic_award(awardId) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_non_academic_awards',
            method: "POST",
            data: { id: awardId },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Non-Academic Award Request successfully deleted.");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }
        });
    }
</script>