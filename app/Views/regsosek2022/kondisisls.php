<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">

            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kondisi SLS</h2>
                        <div class="nav navbar-right panel_toolbox">
                            <a href="/regsosek2022/updatekondisisls" class="btn-sm btn-primary btn-lg active" role="button" aria-pressed="true">Update</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <td class="text-center">ID SLS</th>
                                                <td class="text-center">Nama SLS</th>
                                                <td class="text-center">Mitra</th>
                                                <td class="text-center">Blank</th>
                                                <td class="text-center">Clean</th>
                                                <td class="text-center">Warning</th>
                                                <td class="text-center">Error</th>
                                                <td class="text-center">Total</th>
                                                <td class="text-center">VK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kondisisls as $k) : ?>
                                                <tr>
                                                    <td class="text-center"><?= $k['k_wil']; ?></td>
                                                    <td class="text-center"><?= $k['nama_sls']; ?></td>
                                                    <td class="text-center"><?= $k['mitra']; ?></td>
                                                    <td class="text-center"><?= $k['blank']; ?></td>
                                                    <td class="text-center"><?= $k['clean']; ?></td>
                                                    <td class="text-center"><?= $k['warning']; ?></td>
                                                    <td class="text-center"><?= $k['error']; ?></td>
                                                    <td class="text-center"><?= $k['total']; ?></td>
                                                    <td class="text-center"><?= $k['vk']; ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

</body>

</html>