<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Aweer Supply Chain</title>
    <link rel='stylesheet' href='css/bootstrap.css'>
    <link rel='stylesheet' href='css/all.min.css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="dashboard.php">Aweer Supply Chain</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="logo">
                        <img class="img-responsive img-rounded" src="img/logo-xs.png" alt="User picture">
                    </div>
                </div>

                <div class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>requisition</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="vegetable-requisition.php">Vegetable Requisition</a>
                                    </li>
                                    <li>
                                        <a href="dc-requisition.php">DC Requisition</a>
                                    </li>
                                    <li>
                                        <a href="dsd-requisition.php">DSD Requisition</a>
                                    </li>
                                    <li>
                                        <a href="add-requisition.php">Add requisition</a>
                                    </li>
                                    <li>
                                        <a href="requisition-summary.php">Requisition summary</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Purchase</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="purchase-list.php">purchase list</a>
                                    </li>
                                    <li>
                                        <a href="purchase-order.php">purchase order</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Transfer</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="transfer-list.php">transfer list</a>
                                    </li>
                                    <li>
                                        <a href="add-transfer.php">add transfer</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Receivings</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="lpo-list.php">All LPO Receive</a>
                                    </li>
                                    <li>
                                        <a href="trn-list.php">All TRN Receive</a>
                                    </li>
                                    <li>
                                        <a href="add-lpo-receive.php" data-toggle="modal" data-target="#itemTrackModal">Add LPO Receive</a>
                                    </li>
                                    <li>
                                        <a href="add-trn-receive.php" data-toggle="modal" data-target="#shopTrackModal">Add TRN Receive</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Return</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="purchase-return.php">purchase return list</a>
                                    </li>
                                    <li>
                                        <a href="transfer-return.php">transfer return list</a>
                                    </li>
                                    <li>
                                        <a href="add-purchase-return.php">add purchase return</a>
                                    </li>
                                    <li>
                                        <a href="add-transfer-return.php">add transfer return</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Vendor</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="#">All Vendors</a>
                                    </li>
                                    <li>
                                        <a href="#">add Vendor</a>
                                    </li>
                                    <li>
                                        <a href="vendor-ledger.php">Vendor ledger</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Accounts</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="unpaid-grn.php">unpaid GRN</a>
                                    </li>
                                    <li>
                                        <a href="paid-grn.php">paid GRN</a>
                                    </li>
                                    <li>
                                        <a href="vendor-transaction.php">vendor transaction</a>
                                    </li>
                                    <li>
                                        <a href="payment-voucher.php">payment voucher</a>
                                    </li>
                                    <li>
                                        <a href="payment-summary.php">payment summary</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <div class="dashboard-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header-right">
                            <a href="#">
                                <i class="fas fa-bell" aria-hidden="true"></i><span class="badge badge-danger">01</span>
                            </a>
                            <div class="navbar-profile">
                                <div class="dropdown">
                                    <img class="avatar" src="https://img.faceyourmanga.com/mangatars/1/506/1506353/large_1715077.png" alt="logo">
                                    <div class="dropdown-content">
                                        <ul>
                                            <li><a href="profile.php"><i class="fas fa-cogs"></i> Profile</a></li>
                                            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Item Track LPO Modal -->
        <div class="modal fade" id="itemTrackModal" tabindex="-1" role="dialog" aria-labelledby="itemTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemTrackModalLabel">Item Track</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vendor Invoice No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary mt-4">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Item Track TRN Modal -->
        <div class="modal fade" id="shopTrackModal" tabindex="-1" role="dialog" aria-labelledby="shopTrackModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shopTrackModalLabel">Shop Track</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reference No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Shop Code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary mt-4">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>