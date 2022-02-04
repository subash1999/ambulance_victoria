</div>
<div class="col-2">
    <?php require_once 'snippets/vertical_ad.php' ?>
</div>


</div>
<div class="row">
    <div class="col-12">
        <div class="mt-3">
            <?php require_once 'snippets/horizontal_ad.php' ?>
        </div>
    </div>
</div>
</div>
<script>
    jQuery(function($) {
        $(".datatable").DataTable({
            scrollY: "400px",
            // scrollX: true,
            scrollCollapse: false,
            stateSave: true,
            // dom: "Blfrtip",
            buttons: [],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],
            // fixedColumns: {
            //     leftColumns: 3,
            //     //
            //     rightColumns: 1,
            // },
        })
        .columns.adjust();
    })
</script>
</body>
<footer class="footer mt-auto py-3 bg-light mt-2">
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="d-flex justify-content-around">
                <div>
                    <a href="post.php" class="nav-link active">Post</a>
                </div>
                <div>
                    <a href="user.php" class="nav-link active">User</a>
                </div>
                <div>
                    <a href="image.php" class="nav-link active">Image</a>
                </div>
                <div>
                    <a href="about_us.php" class="nav-link active">About Us</a>
                </div>
            </div>
            <div>&copy Copyright 2022</div>
            <div>Developed By Students for A4 of <b>Developing Web Information Systems</b></div>
        </div>

    </div>
</footer>

</html>