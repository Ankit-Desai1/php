<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Servvice Request</title>
    <link rel="stylesheet" href="./Asset/css/service_request.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php $base_url = 'http://localhost/php/helperland/'; ?>
    <script>
        var config = {
            routes: {
                zone: "<?= $base_url ?>"
            }
        };
    </script>
</head>

<body>

    <section class="header">
        <nav class="navbar navbar-expand-md navbar-dark admin">
            <a class="navbar-brand" href="#"> helplander</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                <div class="navbar-nav ms-auto">

                    <div class="user-icon nav-item">
                        <a href="#"><img src="./Asset/image/user.png" alt="..."></a>
                        <span class="admin-name"><?php echo $_SESSION['username'] ?></span>
                        <a href="<?= $base_url . '?controller=Helperland&function=logout' ?>" id="logout" class="logout"><img src="./Asset/image/logout.png" alt=".."></a>
                    </div>

                </div>

            </div>

        </nav>

    </section>


    <section class="main_content">
        <div class="row" style="height:100%">
            <div class="col-2 verticalnav">
                <div class="button tablinks" onclick="admin(event, 'service_request')" id="defaultopen">
                    <span>
                        Service Request
                    </span>
                </div>

                <div class="button tablinks" onclick="admin(event, 'management')">
                    <span>
                        User Management
                    </span>
                </div>

            </div>
            <div class="col-10 management tabcontent" id="management">

                <div class="row">
                    <div class="col">
                        <p class="text">User management</p>
                    </div>

                    <div class="col" style=" text-align:right">
                        <button class="add_new_user"><span>+</span> Add new user</button>
                    </div>
                </div>
                <br>
                <div class="row user_form">
                    <form action="#" id="formUser">
                        <div class="row mb-3">
                            <div class="col-3">
                                <select class="form-select" aria-label="Default select example" id="all_user">
                                    <option selected>User Name</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-select" aria-label="Default select example" id="user_type">
                                    <option selected>User Type</option>
                                    <option value="1">Service Provider</option>
                                    <option value="2">Customer</option>
                                    <option value="3">Admin</option>
                                </select>
                            </div>
                            <div class=" col-3">
                                <div class="input-group">
                                    <span class="input-group-text  " id="basic-addon1">+45</span>
                                    <input type="text" class="form-control  " placeholder="Mobile number" id="mobile">
                                </div>
                            </div>

                            <div class="col-2">
                                <input type="text" class="form-control  " placeholder="Zip code" id="zipcode">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="Email" id="emailaddress">
                            </div>
                            <div class="col-2" style="display: flex;">
                                <input type="text" class="form-control" placeholder="Start Date" id="startdate">
                            </div>
                            <div class="col-2" style="display: flex;">
                                <input type="text" class="form-control" placeholder="End Date" id="enddate">
                            </div>
                            <div class="col-1">
                                <a class="btn search" id="search_user">Search</a>

                            </div>
                            <div class="col-1">
                                <input class="clear clearuser form-control" type="reset" value="Clear">
                            </div>
                        </div>
                    </form>
                </div>


                <div class="row user_table" id="user_table">
                </div>
                <span class="copyright"> ©2018 Helperland. All rights reserved.
                </span>
            </div>
            <div class="col-10 management tabcontent" id="service_request">

                <div class="row">
                    <div class="col">
                        <p class="text">Service Request</p>
                    </div>
                </div>
                <br>
                <div class="row user_form">
                    <form action="#">
                        <div class="row mb-3">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Service ID" id="service_id">
                            </div>

                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Email" id="email">
                            </div>
                            <div class="col-2">
                                <select class="form-select" id="status">
                                    <option selected>Status</option>
                                    <option value="new">New</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-select" id="all_customer">
                                    <option selected>Customer</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-select" id="all_serviceprovider">
                                    <option selected>Service provider</option>
                                </select>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-2">
                                <input type="text" class="form-control" placeholder="Postal Code" id="Postal_Code">
                            </div>
                            <div class="col-2" style="display: flex;">
                                <input type="text" class="form-control" placeholder="Start Date" id="start_date">
                            </div>

                            <div class="col-2" style="display: flex;">
                                <input type="text" class="form-control" placeholder="End Date" id="end_date">
                            </div>
                            <div class="col-1">
                                <a class="btn search" id="search">Serach</a>
                            </div>

                            <div class="col-1">
                                <input class="clear clearservice form-control" type="reset" value="Clear">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row user_table" id="service_request_table">
                </div>
                <span class="copyright"> ©2018 Helperland. All rights reserved.
                </span>
            </div>
    </section>

    <div class="modal" tabindex="-1" id="editmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert text-center d-none" id="edit_error" role="alert"></div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="serviceDate" class="form-label">Date</label>
                            <input type="text" class="form-control" id="serviceDate">
                        </div>
                        <div class="col-6">
                            <label for="serviceTime" class="form-label">Time</label>
                            <select class="form-select" id="serviceTime">
                                <option selected value="09:00">9:00</option>
                                <option value="09:30">9:30</option>
                                <option value="10:00">10:00</option>
                                <option value="10:30">10:30</option>
                                <option value='11:00'>11:00</option>
                                <option value='11:30'>11:30</option>
                                <option value='12:00'>12:00</option>
                                <option value='12:30'>12:30</option>
                                <option value='13:00'>13:00</option>
                                <option value='13:30'>13:30</option>
                                <option value='14:00'>14:00</option>
                                <option value='14:30'>14:30</option>
                                <option value='15:00'>15:00</option>
                                <option value='15:30'>15:30</option>
                                <option value='16:00'>16:00</option>
                                <option value='16:30'>16:30</option>
                                <option value='17:00'>17:00</option>
                                <option value='17:30'>17:30</option>
                                <option value='18:00'>18:00</option>
                            </select>
                        </div>
                    </div>
                    <p>Service Address</p>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="streetName" class="form-label">Street name</label>
                            <input type="text" class="form-control" id="streetName">
                        </div>
                        <div class="col-6">
                            <label for="houseNo" class="form-label">House number</label>
                            <input type="text" class="form-control" id="houseNo">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="postalCode" class="form-label">Postal code</label>
                            <input type="text" class="form-control" id="postalCode">
                        </div>
                        <div class="col-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                    </div>
                    <p>Invoice Address</p>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="IstreetName" class="form-label">Street name</label>
                            <input type="text" class="form-control" id="IstreetName">
                        </div>
                        <div class="col-6">
                            <label for="IhouseNo" class="form-label">House number</label>
                            <input type="text" class="form-control" id="IhouseNo">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="IpostalCode" class="form-label">Postal code</label>
                            <input type="text" class="form-control" id="IpostalCode">
                        </div>
                        <div class="col-6">
                            <label for="Icity" class="form-label">City</label>
                            <input type="text" class="form-control" id="Icity">
                        </div>
                    </div>
                    <label for="reason" class="form-label">Why do you want to reschedule service request?</label>
                    <textarea class="form-control" id="reason" rows="2" placeholder="Why do you want to reschedule service request?"></textarea>


                    <label for="notes" class="form-label">Call Center EMP Notes</label>
                    <textarea class="form-control" id="notes" rows="2" placeholder="Enter Notes"></textarea>
                    <div class="text-center">
                        <button type="submit" class="update">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="refundmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Refund Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert text-center d-none" id="refund_error" role="alert"></div>
                    <div class="row mb-2">
                        <div class="col-4">
                            <p>Paid Amount</p>
                            <p><span class="amount"></span> <span>€
                                </span></p>
                        </div>
                        <div class="col-4">
                            <p>Refunded Amount</p>
                            <p> <span class="refundamount"></span><span>€
                                </span></p>
                        </div>
                        <div class="col-4">
                            <p>In Balance Amount</p>
                            <p><span class="inbalance"></span> <span>€
                                </span></p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="percentage" class="form-label">Amount</label>
                            <div style="display: flex;">
                                <input type="text" class="form-control" id="percentage">
                                <select class="form-control">
                                    <option selected>Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="calculate" class="form-label">Calculate</label>
                            <div style="display: flex;">
                                <button type="button" class="calculate_btn">Calculate</button>
                                <input type="text" class="form-control" disabled style="cursor: not-allowed;" id="calculate">
                            </div>
                        </div>
                    </div>
                    <label for="refundreason" class="form-label">Why do you want to reschedule service request?</label>
                    <textarea class="form-control" id="refundreason" rows="2" placeholder="Why do you want to reschedule service request?"></textarea>

                    <label for="rnotes" class="form-label">Call Center EMP Notes</label>
                    <textarea class="form-control" id="rnotes" rows="2" placeholder="Enter Notes"></textarea>
                    <div class="text-center">
                        <button type="submit" class="refund">Refund</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./Asset/js/service_request.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <?php
    include("admin_service_request_ajax.php");
    ?>
</body>

</html>