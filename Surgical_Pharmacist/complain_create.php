<?php require_once('headersurg.php');?>
<!-- Main content -->
<div class="content-wrapper">
    <!-- Page header -->
    <div class="page-header page-header-default">
        <div class="page-header-content">
            <div class="page-title">
                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"> Complains </span></h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                    <a href="#" class="btn btn-link btn-float has-text"><i class="icon-notebook text-primary"></i> <span>Reports</span></a>
                </div>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="dashboardsurg.php"><i class="icon-home2 position-left"></i> Home </a></li>
                <li><a href="#"> Complains </a></li>
                <li class="active"> Make a Complain</li>
        </div>
    </div>
    <!-- /page header -->

    <!-- Content area -->
    <div class="content">
        <!-- 2 columns form -->
        <form id="complaincreateform" class="form-horizontal" action="#">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h5 class="panel-title"><b>Make a Complain</b></h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <fieldset>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Employee ID :<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" id="empid" name="empid" class="form-control required"  >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="content-group-lg">
                                    <label class="col-lg-3 control-label">Date of Complain : <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar5"></i></span>
                                            <input type="text"  id="compdate" name="compdate" class="form-control pickadate-strings required" placeholder="Try me&hellip;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Complain</label>
                                <div class="col-lg-9">
                                    <textarea type="text" rows="5" name="complain"
                                                placeholder="Write your Complain here"
                                                class="form-control">
                                    </textarea>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <div class="text-right">
                        <a id="save" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></a>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->

        <!-- Highlighting rows and columns -->
        <div class="panel panel-white">
            <div class="panel-heading">
                <h5 class="panel-title"> <b> Complain List </b></h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                    </ul>
                </div>
            </div>

            <table id="commngtbl" class="table table-bordered table-hover datatable-highlight" class="table bg-slate-600">
                <thead>
                    <tr>
                        <th>Complain No.</th>
                        <th>Employee ID</th>
                        <th>Date</th>
                        <th>Complain</th>
                        <th class="text-center">Actions</th>
                        
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
        <!-- /highlighting rows and columns -->

    </div>
    <!-- /content area -->

    <script>

            //table
        $( document ).ready(function(){

            // Table setup
            // ------------------------------

            // Setting datatable defaults
            $.extend( $.fn.dataTable.defaults, {
                autoWidth: false,
                columnDefs: [{ 
                    orderable: false,
                    width: '100px',
                    targets: [ 2 ]
                }],
                dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
                },
                drawCallback: function () {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
                },
                preDrawCallback: function() {
                    $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
                }
            });

            //datepicker
            $('.pickadate-strings').pickadate({
                weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                showMonthsShort: true
            });

            // Highlighting rows and columns on mouseover
            var lastIdx = null;
            var table = $('.datatable-highlight').DataTable();
            
            $('.datatable-highlight tbody').on('mouseover', 'td', function() {
                var colIdx = table.cell(this).index().column;

                if (colIdx !== lastIdx) {
                    $(table.cells().nodes()).removeClass('active');
                    $(table.column(colIdx).nodes()).addClass('active');
                }
            }).on('mouseleave', function() {
                $(table.cells().nodes()).removeClass('active');
            });


        });

        //save form
        $("#save").click(function(){
        sendData = new FormData($("#complaincreateform")[0]);
    
                $.ajax({
                    method: "POST",
                    url: "../DBhandle/complain_con.php?code=save",
                    data: sendData,
                    processData: false,
                    contentType: false
                }).done(function (msg) {
                    alert(msg);
                });

                // preventDefault();
            });

            function mydatatable(){
    
                $('#commngtbl').DataTable();
            }

            //get data 
            $(document).ready(function () {


            //to table
            $.ajax({
                method: "POST",
                url: "../DBhandle/complain_con.php?code=get_data",
                processData: false,
                contentType: false
            })
                .done(function (data) {
                    $('#commngtbl').DataTable().destroy();
                    $('#commngtbl tbody').append(data);
                    mydatatable();
                });
            });
            
    </script>



</div>
<!-- /Main content -->
<?php require_once('footer.php');?>

