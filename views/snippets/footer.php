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
                    <a href="search.php" class="nav-link active">Search Ambulance</a>
                </div>
                <div>
                    <a href="vehicle_list.php" class="nav-link active">Vehicle List</a>
                </div>
                <div>
                    <a href="company_list.php" class="nav-link active">Company List</a>
                </div>
                <div>
                    <a href="login.php" class="nav-link active">Login</a>
                </div>
                <div>
                    <a href="about_us.php" class="nav-link active">About Us</a>
                </div>
            </div>
            <div>&copy Copyright 2022</div>
            <div>Developed By Students for <b>Capstone Project</b></div>
        </div>

    </div>
</footer>

</html>