<?php
include 'admin/db_connect.php';
include 'auth_check.php';

?>

<head>
    <title>APPLICATION FOR NON-ACADEMIC AWARDS</title>
</head>
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .masthead {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    .masthead:before {
        min-height: 23vh !important;
        height: 23vh !important;
    }

    img#cimg {
        max-height: 10vh;
        max-width: 6vw;
    }

    .password-container {
        position: relative;
    }

    .EyePass {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translate(0, -50%);
        cursor: pointer;
    }


    #eye {
        font-size: 15px;
        color: #7a797e;
    }
</style>
<section id="hero-about" class="d-flex align-items-center">
</section>
<section>
    <div class="container">
        <div class="d-flex justify-content-center" data-aos="zoom-out" data-aos-delay="500">
            <h1 class="text-center" style="margin-bottom : 50px">APPLICATION FOR NON-ACADEMIC AWARDS</h1>
        </div>
    </div>

    <div class="container mt-3 pt-2" data-aos="zoom-out" data-aos-delay="1000">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <form action="" id="non_acad_awards"><br>
                                <h3>Personal Information</h3>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" required>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Department</label>
                                        <select class="custom-select" name="department" id="department" required>
                                            <option value="">Select Department</option>
                                            <option value="CASTE">CASTE</option>
                                            <option value="CBM">CBM</option>
                                            <option value="CCJE">CCJE</option>
                                            <option value="CICS">CICS</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Program</label>
                                        <input type="text" class="form-control" name="program" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Complete Address</label>
                                        <input type="text" class="form-control" name="complete_address" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="gender" class="control-label">Gender</label>
                                        <select id="gender" class="form-control" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div><br>

                                <!-- Service Award -->
                                <h3>Service Award</h3>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Campus Service Award</label>
                                        <select class="custom-select" name="campus_service_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Department Service award</label>
                                        <select class="custom-select" name="department_service_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Community Service Award</label>
                                        <select class="custom-select" name="community_service_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label for="accomplishments" class="control-label">Accomplishments</label>
                                        <textarea name="accomplishments" id="accomplishments" class="form-control"
                                            required></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="organized_by" class="control-label">Organized by</label>
                                        <input type="text" name="organized_by" id="organized_by" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inclusive_dates" class="control-label">Inclusive Dates</label>
                                        <input type="date" name="inclusive_dates" id="inclusive_dates"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="venue" class="control-label">Venue</label>
                                        <input type="text" name="venue" id="venue" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Campus Ministry Award</label>
                                        <select class="custom-select" name="campus_ministry_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">What ministry?</label>
                                        <select class="custom-select" name="what_ministry" required>
                                            <option value="">Select what ministry?</option>
                                            <option value="altar_servers">Altar Servers</option>
                                            <option value="music">Music</option>
                                            <option value="lectors">Lectors</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Inclusive Years</label>
                                        <input type="text" name="inclusive_years_ministry" class="form-control" id=""
                                            required>
                                    </div>

                                </div><br>

                                <!-- Leadership Award -->
                                <h3>Leadership Award</h3>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Campus Leadership Award</label>
                                        <select class="custom-select" name="campus_leadership_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Department Leadership award</label>
                                        <select class="custom-select" name="department_leadership_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Community Leadership Award</label>
                                        <select class="custom-select" name="community_leadership_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="position" class="control-label">Position</label>
                                        <input type="text" name="position" id="" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="organization" class="control-label">Organization</label>
                                        <input type="text" name="organization" id="organization" class="form-control"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inclusive_years_organization" class="control-label">Inclusive
                                            Years</label>
                                        <input type="text" name="inclusive_years_organization"
                                            id="inclusive_years_organization" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label for="campus_ministry_leadership_award" class="control-label">Campus
                                            Ministry Leadership</label>
                                        <select class="custom-select" name="campus_ministry_leadership_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="what_ministry_leadership" class="control-label">What
                                            ministry?</label>
                                        <select class="custom-select" name="what_ministry_leadership" required>
                                            <option value="">Select what ministry?</option>
                                            <option value="altar_servers">Altar Servers</option>
                                            <option value="music">Music</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="position_ministry_leadership" class="control-label">Position</label>
                                        <input type="text" name="position_ministry_leadership" id=""
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inclusive_years_ministry_leadership" class="control-label">Inclusive
                                            Years</label>
                                        <input type="text" name="inclusive_years_ministry_leadership" id=""
                                            class="form-control" required>
                                    </div>
                                </div><br>

                                <!-- Cultural Award -->
                                <h3>Cultural Award</h3>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="graphic_arts_award" class="control-label">Graphic Arts Award</label>
                                        <select class="custom-select" name="graphic_arts_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="performing_arts_award" class="control-label">Performing Arts
                                            Award</label>
                                        <select class="custom-select" name="performing_arts_award" required>
                                            <option value="">Select yes or no</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Accomplishments</label>
                                        <textarea name="cultural_accomplishments" id="cultural_accomplishments"
                                            class="form-control" required></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Organized by</label>
                                        <input type="text" name="cultural_organized_by" id="organized_by"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Inclusive Dates</label>
                                        <input type="date" name="cultural_inclusive_dates" id="inclusive_dates"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="control-label">Venue</label>
                                        <input type="text" name="cultural_venue" id="venue" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="attachment" class="control-label">Attachment</label>
                                        <input type="file" name="attachment" id="attachment" class="form-control"
                                            required>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="clarify" class="control-label">Clarify</label>
                                        <input type="hidden" name="clarify" value="Disagree">
                                        <input type="checkbox" name="clarify" id="clarify" value="Agree" required>
                                        <p>I certify that the above information are true and correct to the best of my
                                            knowledge.</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div id="msg"></div>

                                        <button id="submitBtn" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            if (typeof openLoginModal !== 'undefined' && openLoginModal) {
                uni_modal("Login", "popup.php");
            }
        });


        $(document).ready(function () {
            // Add an event listener to the form submission
            $('#non_acad_awards').submit(function (e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Check if the form is valid
                if (this.checkValidity()) {
                    start_load(); // Start a loading indicator (if available)

                    // Send the form data to the server using AJAX
                    $.ajax({
                        url: 'admin/ajax.php?action=saveNonAcademicAwards', // URL of the server-side script
                        data: new FormData($(this)[0]), // Form data to be sent
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST',
                        type: 'POST',
                        success: function (resp) {
                            // Display a message based on the response from the server
                            $('#msg').html('<div class="alert alert-success">' + resp + '</div>');
                            end_load(); // End the loading indicator (if available)

                            // Reset the form after successful submission
                            $('#non_acad_awards')[0].reset();
                        },
                        error: function (xhr, status, error) {
                            // Display an error message if the request fails
                            $('#msg').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                            end_load(); // End the loading indicator (if available)
                        }
                    });
                } else {
                    // If the form is invalid, display a message or perform other actions
                    // For example, you can display a message to the user to fill in all required fields
                    $('#msg').html('<div class="alert alert-danger">Please fill in all required fields.</div>');
                }
            });
        });

    </script>
</section>