<?php
require_once 'process_inventory.php';

include('sidebar.php');
$getLastItem = mysqli_query($mysqli, "SELECT * FROM inventory");
$lastItemID = 0;
while ($newLastItem = mysqli_fetch_array($getLastItem)) {
    $lastItemID = $newLastItem['id'];
}

$getItems = mysqli_query($mysqli, "SELECT * FROM inventory");

if(!isset($_GET['item_id'])){
    ?>
<meta http-equiv = "refresh" content = "0; url = inventory.php" />
<?php
    }
    else{

    }
?>
<title>Inventory - Celine & Peter Store</title>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?php
        include('topbar.php');
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
            </div>

            <!-- Alert here -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= $_SESSION['msg_type'] ?> alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>
            <!-- End Alert here -->

            <!-- Add Student -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Add Inventory</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" action="process_inventory.php">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th width="5%">Item ID</th>
                                    <th width="">Item Code</th>
                                    <th width="">Item Name</th>
                                    <th width="">Quantity</th>
                                    <th width="">(₱) Unit Price</th>
                                    <th width="">(₱) Total Cost</th>
                                    <th width="30%">Description (Optional)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="text" name="item_id" class="form-control" value="<?php echo ++$lastItemID; ?>" required readonly></td>
                                    <td><input type="text" name="item_code" class="form-control" required></td>
                                    <td><input type="text" name="item_name" class="form-control" required></td>
                                    <td><input type="number" name="qty" class="form-control" required></td>
                                    <td><input type="number" name="price" class="form-control" required></td>
                                    <td><input type="number" name="total_cost" class="form-control" required></td>
                                    <td><textarea name="description" class="form-control" style="min-height: 100px;"></textarea></td>
                                </tr>
                                </tbody>
                            </table>
                            <button class="float-right btn btn-sm btn-primary m-1" name="save" type="submit"><i class="far fa-save" ></i> Save</button>
                            <a href="student.php" class="btn btn-danger btn-sm m-1 float-right"><i class="fas as fa-sync"></i> Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Add Student -->

            <!-- List of Student -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List of Items</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="studentTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>QTY (Stock)</th>
                                <th>Price</th>
                                <th>Total Sold</th>
                                <th>Update QTY</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while($newItems = $getItems->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $newItems['item_code']; ?></td>
                                    <td><?php echo $newItems['item_name']; ?></td>
                                    <td><?php echo $newItems['item_description']; ?></td>
                                    <td><?php echo $newItems['qty']; ?></td>
                                    <td><?php echo $newItems['item_price']; ?></td>
                                    <td><?php echo 'total sold here'; ?></td>
                                    <td><?php echo 'Update Stock'; ?></td>
                                    <td>
                                        <!-- Start Drop down Delete here -->
                                        <button class="btn btn-danger btn-secondary dropdown-toggle btn-sm mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton btn-sm">
                                            Are you sure you want to delete? You cannot undo the changes<br/>
                                            <a href="process_inventory.php?delete=<?php echo $newItems['id']; ?>" class='btn btn-danger btn-sm'>
                                                <i class="far fa-trash-alt"></i> Confirm Delete
                                            </a>
                                            <a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div style="text-align: center;"><b>Total Items: <?php echo 'asd'; ?></b></div>
                    </div>
                </div>
            </div>
            <!-- End Student Lists -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- JS here -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#studentTable').DataTable( {
                "pageLength": 25
            } );
        } );
    </script>
    <?php
    include('footer.php');
    ?>