@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('css')
{{-- <link rel="stylesheet" href="https://unpkg.com/gridjs@1.2.0/dist/theme/mermaid.min.css" />
  <script src="https://unpkg.com/gridjs@1.2.0"></script> --}}
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/choices.js/choices.js.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Dashboard') }}
        @endslot
        @slot('title')
            {{ __('Overall') }}
        @endslot
    @endcomponent
@endsection

@section('pagecontentinfo')
@endsection
<div class="card ">

    <div class="card-header justify-content-between  align-items-center">

        <div class="row">
            <div class="col-md-10">
                <h4 class="card-title"> {{ __('Filters') }} </h4>

            </div>
            <div class="col-md-2">
                <button class="btn btn-primary " id="search"> {{ __('Search') }} </button>

            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <div id="reportrange"
                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
            </div>



        </div>
    </div>



</div>
<div class="row card ">
    <div class="card-header">
        <h4>{{ __('Counts') }} </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title"> {{ __('Institutes') }} </h4>

                    </div>
                    <div class="card-body" data-toggle="modal" data-target=".bd-example-modal-lg">
                        <h3 class=" mb-0 spinner-border cp inst_count loader-item "> </h3>


                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title"> {{ __('Courses') }} </h4>
                    </div>
                    <div class="card-body" data-toggle="modal" data-target="#coursesModal">
                        <h3 class=" mb-0 spinner-border cp  course_count loader-item"> </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{ __('Students') }} </h4>
                    </div>
                    <div class="card-body" data-toggle="modal" data-target="#studentsModal">
                        <h3 class=" mb-0 spinner-border cp stu_count loader-item "> </h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{ __('Orders') }} </h4>
                    </div>
                    <div class="card-body" data-toggle="modal" data-target="#ordersModal">
                        <h3 class=" mb-0 spinner-border cp order_count loader-item "> </h3>

                    </div>
                </div>
            </div>
        </div>

    </div>




</div>
<div class="row card ">

    <div class="card-header">
        <h4>Sales</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{ __('Total Sales') }} </h4>
                    </div>
                    <div class="card-body">
                        <h3 class=" mb-0 spinner-border cp total_sales loader-item "> </h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{ __('Total Commission') }} </h4>
                    </div>
                    <div class="card-body">
                        <h3 class=" mb-0 spinner-border cp total_commission loader-item "> </h3>

                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header justify-content-between d-flex align-items-center">
                        <h4 class="card-title">{{ __('Today Sale') }} </h4>
                    </div>
                    <div class="card-body">
                        <h3 class=" mb-0 spinner-border cp today_sale  loader-item"> </h3>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
{{-- Order Graph Yearly   --}}
<div class="row card ">
    <div class="col-lg-12 card-header ">
        <div class="spinner-border loader-item  "></div>
        <canvas id="myChart"></canvas>

    </div>
</div>

{{-- Recent Orders  --}}
<div class="row card ">

    <div class="col-lg-12 card-header">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('Recent Orders') }} </h4>
            </div>
            <div class="card-body">
                <div class="spinner-border  loader-item "></div>

                <div id="Table"></div>
            </div>
        </div>
    </div>

</div>

{{-- Modals  --}}

<!-- Large modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large
    modal</button> --}}

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Institutes') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="InstTable"></div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Courses  --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" id="coursesModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Courses') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="courseTable"></div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Students  --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" id="studentsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Students') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="studentTable"></div>
                </div>
            </div>

        </div>
    </div>
</div>
{{-- Orders  --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" id="ordersModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Orders') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="orderTable"></div>
                </div>
            </div>

        </div>
    </div>
</div>



@endsection
@section('script')
<!-- gridjs js -->
<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<script>
    // Init DateRange picker 
    // docs :- https://www.daterangepicker.com/#google_vignette 

    var start = moment().subtract(29, 'days');
    var end = moment();

    let orderChart;
    let grid = undefined;
    var courseGrid = undefined;
    var studentGrid = undefined;
    var orderGrid = undefined;

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);

    cb(start, end);

    $('#search').on('click', function() {
        var startDate = $('#reportrange').data('daterangepicker').startDate;
        var endDate = $('#reportrange').data('daterangepicker').endDate;

        loadDashboardData(startDate.format('YYYY-MM-DD'), endDate.format('YYYY-MM-DD'));

        // Do something with the selected start and end dates
        console.log("Start Date: " + startDate.format('YYYY-MM-DD'));
        console.log("End Date: " + endDate.format('YYYY-MM-DD'));
    });


    function loadDashboardData(start_date = null, end_date = null) {


        $('.loader-item').addClass('spinner-border');
        $('.loader-item').text('');
        var apiBase = `{{ url('/') }}`;
        apiBase += "/api/";

        var isFilter = false;

        if (start_date == null && end_date == null) {

            var URL = `${apiBase}dashboard`;
        } else {

            var URL = `${apiBase}dashboard?start_date=${start_date}&end_date=${end_date}`;
            isFilter = true;

        }



        $.get(URL, (res) => {
            if (res.code == 200) {
                console.log(res, "res")

                $('.spinner-border').removeClass('spinner-border');
                var data = res.data

                console.log(data)
                $('.inst_count').text(data.institutes.total_institute)
                $('.stu_count').text(data.students.total_students)
                $('.course_count').text(data.courses.total_courses)
                $('.order_count').text(data.orders.total_orders)
                $('.total_sales').text("$" + data.orders.total_sales)
                $('.today_sale').text("$" + data.orders.today_sale)
                $('.total_commission').text("$" + data.orders.total_commission)
                buildOrderChart(data.orders.graph_data)
                initRecentOrders(data.orders.recent)
                loadInstitutes(data.institutes.data, isFilter)
                loadCourses(data.courses.data, isFilter)
                loadStudents(data.students.data, isFilter)
                loadOrders(data.orders.data, isFilter)
                console.log(data.institutes.data)

                return
            } else {
                console.log(res)
                alert(res.message)
            }
        })
    }

    setTimeout(loadDashboardData, 1000);


    function buildOrderChart(month_data) {
        const labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
        // 3C1D55
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Monthly Orders Chart',
                    data: month_data,
                    borderColor: '#3C1D55',
                    backgroundColor: '#8B80D6',
                    fill: true,
                }

            ]
        };


        const config = {
            type: 'line',
            data: data,
            destroy: true,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Monthly Orders Chart'
                    }
                }
            },
        };
        if (orderChart) {
            orderChart.destroy();
        }
        const ctx = document.getElementById('myChart');
        orderChart = new Chart(ctx, config);
    }



    function initRecentOrders(orders) {


        orders = orders.map(order => Object.values(order));

        console.log(orders, " The the init fun ")
        var apiBase = `{{ url('/') }}`;
        apiBase = apiBase + '/api/'

        var success = `{{ __('Success') }}`;
        var failed = `{{ __('Failed') }}`;

        const grid = new gridjs.Grid({
            columns: [{
                    name: `{{ __('Order ID') }}`,
                    formatter: (cell, row) => row._cells[0].data

                },
                {
                    name: `{{ __('Transaction ID') }}`,
                    formatter: (cell, row) => row._cells[1].data
                },
                {
                    name: `{{ __('Product Name') }}`,
                    formatter: (cell, row) => row._cells[2].data
                },
                {
                    name: `{{ __('Status') }}`,
                    formatter: (cell, row) => {
                        const status = row._cells[3].data;
                        if (status === 1) {
                            return gridjs.html(
                                `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('success') }}</span>`
                            );
                        } else {
                            return gridjs.html(
                                `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('failed') }}</span>`
                            );
                        }
                    }
                },
                {
                    name: `{{ __('Amount') }}`,
                    formatter: (cell, row) => row._cells[4].data
                },
                {
                    name: `{{ __('Date') }}`,
                    formatter: (cell, row) => row._cells[5].data
                },
            ],
            search: true,
            sort: true,
            resizable: true,
            pagination: {
                enabled: true,
                limit: 10,
            },
            data: orders
        });

        grid.render(document.getElementById('Table'));



    }

    var loadInstitutes = async (orders, isFilter) => {
        
       
        if (isFilter) {
            var instContainer = document.getElementById('InstTable')
            console.log(" This are the orders bfore map ", orders);
         
            // orders = orders.map(order => Object.values(order));
            console.log(" This are the orders after map ", orders);
            window.grid.updateConfig({            
                
                data: orders
            }).forceRender(instContainer)
        } else {

            var instContainer = document.getElementById('InstTable')
        
            console.log(orders, " The the orders  before map  ")

            orders = orders.map(order => Object.values(order));


            console.log(orders, " The   orders after  ")
        

            var success = `{{ __('Success') }}`;
            var failed = `{{ __('Failed') }}`;

            window.grid = new gridjs.Grid({
                columns: [{
                        name: `{{ __('Name') }}`,
                        formatter: (cell, row) => cell

                    },
                    {
                        name: `{{ __('Email') }}`,
                        formatter: (cell, row) => {
                            return cell;
                        }
                    },
                    {
                        name: `{{ __('Address') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Status') }}`,
                        width: '100px',
                        formatter: (cell, row) => {
                            if (cell == 1) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                                )
                            } else if (cell == 0) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Blocked') }}  </span>`
                                )


                            } else if (cell == 2) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-warning" data-key="t-hot">{{ __('Pending') }}  </span>`
                                )
                            } else if (cell == 3) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Rejected') }}  </span>`
                                )
                            } else if (cell == 4) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Incomplete') }}  </span>`
                                )
                            }
                        }
                    }

                ],
                search: true,
                sort: true,
                resizable: true,
                pagination: {
                    enabled: true,
                    limit: 10,
                },
                data: orders
            }).render(instContainer);

            console.log(" This is the grid ", window.grid )
        }

    }


    var loadCourses = async (orders, isFilter) => {
        // InstTable
        if (isFilter) {
            orders = orders.map(order => Object.values(order));
            window.courseGrid.updateConfig({
                data: orders
            }).forceRender();
        } else {

            var courseContainer = document.getElementById('courseTable')
            $(courseContainer).empty();
            orders = orders.map(order => Object.values(order));

            var success = `{{ __('Success') }}`;
            var failed = `{{ __('Failed') }}`;

            window.courseGrid = new gridjs.Grid({
                columns: [{
                        name: `{{ __('Name') }}`,
                        formatter: (cell, row) => cell

                    },
                    {
                        name: `{{ __('Title') }}`,
                        formatter: (cell, row) => {
                            return cell;
                        }
                    },
                    {
                        name: `{{ __('Price') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Selling Price') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Mode') }}`,
                        formatter: (cell, row) => {
                            if (cell == 1) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Online') }} </span>`
                                )
                            } else if (cell == 0) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Offline') }}  </span>`
                                )


                            }
                        }
                    },



                ],
                search: true,
                sort: true,
                resizable: true,
                pagination: {
                    enabled: true,
                    limit: 10,
                },
                data: orders
            }).render(courseContainer);

        }

    }


    var loadStudents = async (orders, isFilter) => {
        // InstTable
        if (isFilter) {
            orders = orders.map(order => Object.values(order));

            window.studentGrid.updateConfig({
                data: orders
            }).forceRender();
        } else {

            var studentContainer = document.getElementById('studentTable')
            $(studentContainer).empty();
            orders = orders.map(order => Object.values(order));

 
            var success = `{{ __('Success') }}`;
            var failed = `{{ __('Failed') }}`;

            window.studentGrid = new gridjs.Grid({
                columns: [{
                        name: `{{ __('Name') }}`,
                        formatter: (cell, row) => cell

                    },
                    {
                        name: `{{ __('Email') }}`,
                        formatter: (cell, row) => {
                            return cell;
                        }
                    },
                    {
                        name: `{{ __('Mobile') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Address') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Status') }}`,
                        formatter: (cell, row) => {
                            if (cell == 1) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                                )
                            } else if (cell == 0) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Blocked') }}  </span>`
                                )


                            }
                        }
                    },



                ],
                search: true,
                sort: true,
                resizable: true,
                pagination: {
                    enabled: true,
                    limit: 10,
                },
                data: orders
            }).render(studentContainer);

        }

    }


    var loadOrders = async (orders, isFilter) => {
        // InstTable
        if (isFilter) {
            orders = orders.map(order => Object.values(order));

         
            window.orderGrid.updateConfig({
                data: orders
            }).forceRender();
        } else {

            var orderContainer = document.getElementById('orderTable')
            $(orderContainer).empty();
            orders = orders.map(order => Object.values(order));

        

            var success = `{{ __('Success') }}`;
            var failed = `{{ __('Failed') }}`;

            window.orderGrid = new gridjs.Grid({
                columns: [{
                        name: `{{ __('ID') }}`,
                        formatter: (cell, row) => cell

                    },
                    {
                        name: `{{ __('Transaction ID') }}`,
                        formatter: (cell, row) => {
                            return cell;
                        }
                    },
                    {
                        name: `{{ __('Amount') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Commission') }}`,
                        formatter: (cell, row) => cell
                    },
                    {
                        name: `{{ __('Status') }}`,
                        formatter: (cell, row) => {
                            if (cell == 1) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Success') }} </span>`
                                )
                            } else if (cell == 0) {
                                return gridjs.html(
                                    `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Failed') }}  </span>`
                                )


                            }
                        }
                    },



                ],
                search: true,
                sort: true,
                resizable: true,
                pagination: {
                    enabled: true,
                    limit: 10,
                },
                data: orders
            }).render(orderContainer);

        }

    }

</script>
@endsection
