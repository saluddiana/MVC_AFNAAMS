<?php include ('db_connect.php'); ?>
<title>All Non-Academic Awards List</title>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-lg-12">
            <!-- Table Panel -->
            <div class="card">
                <div class="card-header">
                    <b>All Non-Academic Awards List </b>
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
                                <th class="text-center">Campus Service Award</th>
                                <th class="text-center">Department Service Award</th>
                                <th class="text-center">Community Service Award</th>
                                <th class="text-center">Accomplishments</th>
                                <th class="text-center">Organized By</th>
                                <th class="text-center">Inclusive Dates</th>
                                <th class="text-center">Venue</th>
                                <th class="text-center">Campus Ministry Award</th>
                                <th class="text-center">What Ministry</th>
                                <th class="text-center">Inclusive Years Ministry</th>
                                <th class="text-center">Campus Leadership Award</th>
                                <th class="text-center">Department Leadership Award</th>
                                <th class="text-center">Community Leadership Award</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Organization</th>
                                <th class="text-center">Inclusive Years Organization</th>
                                <th class="text-center">Campus Ministry Leadership Award</th>
                                <th class="text-center">What Ministry Leadership</th>
                                <th class="text-center">Position Ministry Leadership</th>
                                <th class="text-center">Inclusive Years Ministry Leadership</th>
                                <th class="text-center">Graphic Arts Award</th>
                                <th class="text-center">Performing Arts Award</th>
                                <th class="text-center">Cultural Accomplishments</th>
                                <th class="text-center">Cultural Organized By</th>
                                <th class="text-center">Cultural Inclusive Dates</th>
                                <th class="text-center">Cultural Venue</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            $non_academic_awards = $conn->query("SELECT * FROM non_academic_awards WHERE status = '1' AND archive = 1 ORDER BY id ASC");
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
                                    <td class="text-center"><?php echo $row['campus_service_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['department_service_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['community_service_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['accomplishments'] ?></td>
                                    <td class="text-center"><?php echo $row['organized_by'] ?></td>
                                    <td class="text-center"><?php echo $row['inclusive_dates'] ?></td>
                                    <td class="text-center"><?php echo $row['venue'] ?></td>
                                    <td class="text-center"><?php echo $row['campus_ministry_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['what_ministry'] ?></td>
                                    <td class="text-center"><?php echo $row['inclusive_years_ministry'] ?></td>
                                    <td class="text-center">
                                        <?php echo $row['campus_leadership_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['department_leadership_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['community_leadership_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['position'] ?></td>
                                    <td class="text-center"><?php echo $row['organization'] ?></td>
                                    <td class="text-center"><?php echo $row['inclusive_years_organization'] ?></td>
                                    <td class="text-center">
                                        <?php echo $row['campus_ministry_leadership_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['what_ministry_leadership'] ?></td>
                                    <td class="text-center"><?php echo $row['position_ministry_leadership'] ?></td>
                                    <td class="text-center"><?php echo $row['inclusive_years_ministry_leadership'] ?></td>
                                    <td class="text-center"><?php echo $row['graphic_arts_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['performing_arts_award'] == 1 ? 'Yes' : 'No'; ?>
                                    </td>
                                    <td class="text-center"><?php echo $row['cultural_accomplishments'] ?></td>
                                    <td class="text-center"><?php echo $row['cultural_organized_by'] ?></td>
                                    <td class="text-center"><?php echo $row['cultural_inclusive_dates'] ?></td>
                                    <td class="text-center"><?php echo $row['cultural_venue'] ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary unarchive" data-id="<?php echo $row['id'] ?>"
                                            type="button">Unarchive</button>

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
    $('.unarchive').click(function () {
        var awardId = $(this).data('id');
        _conf("Are you sure to unarchive this non-academic award?", "unarchive_non_academic_awards", [awardId]);
    });

    function unarchive_non_academic_awards(awardId) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=unarchive_non_academic_awards',
            method: "POST",
            data: { id: awardId },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Non-Academic Award successfully unarchived.");
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    console.log(resp);
                }
            }
        });
    }

</script>