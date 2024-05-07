<?php
ob_start();
require_once '../../../config/database.php';
require_once '../../../app/Topups.php';
include_once '../../layouts/link.php';
include_once '../../layouts/header.php';
include_once '../../layouts/sidebar.php';

$database = new Database();
$db = $database->dbConnection();

$top = new Topups($db);

// Check if the id parameter exists in the URL
if(isset($_GET['id'])){
    $top->id = $_GET['id'];

    if($top->delete()){
        header("Location: index.php");
    }else{
        echo "Gagal menghapus produk.";
    }
}

// Fetch data using the index method
$data = $top->index();
?>

    <style>
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>

<body>
    <div class="container-fluid px-4">
        <h1 class="mt-4 me-5 text-center">Daftar Top Up</h1>
    </div>
    <hr>
    <div class="container">
    <table class="table table-bordered table-hover" style="border: 3px solid;">
            <thead class="table" style="background-color: red; text-align:center;">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Game ID</th>
                    <th>Amount</th>
                    <th>Date</th> 
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($data as $row) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['game_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['topup_date']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="create.php" class="btn btn-primary mb-3"><i class="fas fa-plus me-2"></i></i> Tambah</a> <!-- Tautan Tambah -->
    </div>
</body>
</html>

<?php
include_once '../../layouts/footer.php';
?>
