<?php
//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);
$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows;
$jumlah_gallery = $hasil2->num_rows;

//query untuk mengambil data gallery
//$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
//$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data gallery
//$jumlah_gallery = $hasil2->num_rows;
?>
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <a href="admin.php?page=article" class="text-decoration-none">
        <div class="col">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-3">
                            <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </a>
    <a href="admin.php?page=gallery" class="text-decoration-none">
        <div class="col">
            <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-3">
                            <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                        </div>
                        <div class="p-3">
                            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<footer class="text-center p-5 bg-danger-subtle footer fixed-bottom">
    <div>
        <a href="https://www.instagram.com/udinusofficial"
        ><i class="bi bi-instagram h2 p-2 text-dark"></i
        ></a>
        <a href="https://twitter.com/udinusofficial"
        ><i class="bi bi-twitter h2 p-2 text-dark"></i
        ></a>
        <a href="https://wa.me/+62812685577"
        ><i class="bi bi-whatsapp h2 p-2 text-dark"></i
        ></a>
    </div>
    <div>Dede Nur Fikri &copy; 2024</div>
    </footer>