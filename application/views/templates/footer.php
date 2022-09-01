<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sitem Penggajian by Kelompok 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() . 'assets/vendor/jquery/jquery.min.js'; ?>"></script>
<script src="<?= base_url() . 'assets/vendor/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() . 'assets/vendor/jquery-easing/jquery.easing.min.js'; ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() . 'assets/js/sb-admin-2.min.js'; ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url() . 'assets/vendor/chart.js/Chart.min.js'; ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() . 'assets/js/demo/chart-area-demo.js'; ?>"></script>
<script src="<?= base_url() . 'assets/js/demo/chart-pie-demo.js'; ?>"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
    function totalCPP(){
        const poinlembur = document.getElementById('poinLembur').value
        const costperpoin = document.getElementById('costPerPoin').value
        const totalCost = poinlembur * costperpoin
        return document.getElementById('totalCost').value = totalCost
        // console.info(totalCost)
    }

    // function validationScore(){
    //     const score = document.getElementById('score').value
    //     if(score >= 100){
    //         return document.getElementById('valid').value = "Score melebihi 100"
    //     } else {
    //         return document.getElementById('valid').value = ""
    //     }
    // }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#namaKaryawan').autocomplete({
            source: "<?= site_url('hrd/autoCompleteNamaKaryawan/?'); ?>"
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#table_karyawan').DataTable({
            dom: 'lfrti<t>Bp',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('#tableIstri').DataTable({});
        $('#tableAnak').DataTable({});

        $('#tblKaryawanGaji').DataTable({});
        $('#table_absensi').DataTable({});

        
    });

    $(document).ready(function() {
        $(".preloader").fadeOut();
    });

    function printSlipGaji(slip){
        var printContents = document.getElementById(slip).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

<script>
    $('#inputGroupFile01').on('change', function() {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', "");
        //replace the Choose File label'
        $(this).next('.custom-file-label').html(fileName);
    })
</script>

</body>

</html>