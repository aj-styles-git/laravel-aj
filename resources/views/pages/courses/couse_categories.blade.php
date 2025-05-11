@extends('layouts.vertical-master-layout')
@section('title')
    {{ __('Categories') }}
@endsection
@section('css')
    <!-- plugin css -->

    <!-- One of the following themes -->
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/libs/gridjs/gridjs.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{-- breadcrumbs  --}}
@section('breadcrumb')
    @component('components.breadcrumb')
        @slot('li_1')
            {{ __('Categories') }}
        @endslot
        @slot('title')
            {{ __('Category') }}
        @endslot
    @endcomponent
@endsection
<div class="row">


    <div class="col-md-12">
        <button id="addBTN" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
            style="width:78px; float:right">
            {{ __('Add') }}
        </button>
    </div>

    <div class="col-lg-12 mt-4">
        <div class="card">
            <div class="card-header justify-content-between d-flex align-items-center">
                <h4 class="card-title">{{ __('Categories') }} </h4>
            </div>
            <div class="card-body">
                <div id="Table"></div>
            </div>
        </div>
    </div>







</div><!-- end row -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 800px ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Create Category') }}</h5>
                    <button type="button" class="close close_mdl" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                   
                    <div class="row">
                        <form id="AddFormSubmit">


                            <div class="row">
                                <div class="col-lg-6 ">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input" class="form-label">
                                            {{ __('Name') }} </label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="{{ __('Name') }}" autocomplete="false">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-single-default"
                                            class="form-label font-size-13 text-muted">{{ __('Status') }}</label>
                                        <div class="text-danger" id="country_id">

                                        </div>
                                        <select class="form-control" data-trigger name="stat" id="stat">
                                            <option value="" disabled>{{ __('Please Select Status') }} </option>
                                            <option value="1" selected> {{ __('Active') }} </option>
                                            <option value="0"> {{ __('Inactive') }}</option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                             <!-- Add this line to include the icon/image upload field -->
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">{{ __('Category Icon/Image') }}</label>
                                    <input type="file" class="form-control" name="icon" id="icon" accept="image/*">
                                </div>
                            </div>
                            </div>

                        </form>

                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" onclick="addCategory(this)" class="btn btn-primary" id="saveBTN">
                        {{ __('Save') }}
                        <button type="button" id="updateBTN" onclick="updateCat(this)" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
<script src="{{ URL::asset('assets/js/app.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

<script src="{{ URL::asset('assets/libs/gridjs/gridjs.min.js') }}"></script>


<script>
    $('#updateBTN').hide();

    var apiBase = `{{ url('/') }}`;

    apiBase += '/api/'

    var addURL = `${apiBase}courses/categories`;

    const grid = new gridjs.Grid({
        columns: [{
                name: "ID ",
                hidden: true
            },
            {
                name: 'Name',
            },
            {
                name: 'Icon',
                formatter: (cell) => {
                    if (!cell) {
                        return gridjs.html(
                            `<div style="color: red; font-size: 12px;">Image not available</div>`
                        );
                    }

                    return gridjs.html(
                        `<img 
                            src="/storage/${cell}" 
                            alt="Icon" 
                            style="height: 80px; width: 80px; border-radius: 12px; object-fit: cover; box-shadow: 0 2px 8px rgba(0,0,0,0.15);" 
                            onerror="this.style.display='none'; this.insertAdjacentHTML('afterend', '<div style=\\'color:red; font-size:12px;\\'>Image not found</div>')"
                        />`
                    );
                }
            },
            {
                name: 'Status',
                width: '100px',
                formatter: (cell, row) => {
                    if (cell == 1) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-success" data-key="t-hot">{{ __('Active') }} </span>`
                        )
                    } else if (cell == 0) {
                        return gridjs.html(
                            `<span class="badge rounded-pill badge-soft-danger" data-key="t-hot">{{ __('Inactive') }}  </span>`
                        )


                    }
                }
            },


            {
                name: 'Action',
                width: '90px',
                formatter: (cell, row) => {
                    return gridjs.html(`    
                    
                    <div class="overlay-content rounded-top">
                        <div>
                            <div class="user-nav p-3">
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal font-size-20 text-primary"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li class=" cp dropdown-item "  onclick='edit(this, ${cell})' >Edit </li>
                                               <li class="dropdown-item" style="cursor: pointer;" onclick='toggleStatus(${row['_cells'][0]['data']}, this, ${row['_cells'][3]['data']})'>
                                ${row['_cells'][3]['data'] == 1 ? '{{ __('Inactive') }}' : '{{ __('Active') }}'}
                                </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                            
                            `)
                }
            }

        ],
        search: true,
        sort: true,
        resizable: true,
        language: {
            pagination: {
                previous: `{{ __('Previous') }}`,
                next: `{{ __('Next') }}`,
            },
        },
        pagination: {
            enabled: true, // Enable pagination
            limit: 10, // Set the number of rows per page
        },
        server: {
            url: addURL,
            method: 'GET',
            then: (res) => {
                var data = res['data'];
                return data.map(inst => [inst.id, inst.name ? inst.name : "-", inst.icon, inst.status, inst.id]);
            },
            handle: (res) => {
                console.log(res)
                if (res.status === 404) return {
                    data: []
                };
                if (res.ok) return res.json();
                throw Error('Oh no :(');
            }

        }
    });


    grid.render(document.getElementById('Table'));




        function addCategory(e) {
        e.disabled = true;
    
        var formData = new FormData();
        formData.append('name', $('input[name=name]').val());
        formData.append('status', $('#stat').val());
        formData.append('icon', $('#icon')[0].files[0]); // Add the icon/image file
    
        $.ajax({
            url: addURL,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    $('.close_mdl').trigger('click');
                    alert(res.message);
                    $("#AddFormSubmit")[0].reset();
                    e.disabled = false;
                    location.reload(); 
                } else {
                    alert(res.message);
                    e.disabled = false;
                }
            },
            error: function () {
                alert('{{ __('An error occurred while adding the category.') }}');
                e.disabled = false;
            }
        });
    }
    
    function updateCat(e) {
        e.disabled = true;
    
        var id = $('#updateBTN').attr('data-id');
        var formData = new FormData();
        formData.append('name', $('input[name=name]').val());
        formData.append('status', $('#stat').val());
        formData.append('icon', $('#icon')[0].files[0]); // Add the icon/image file
    
        var url = `${addURL}/${id}`;
    
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.code == 200) {
                    $('.close_mdl').trigger('click');
                    alert(res.message);
                    $("#AddFormSubmit")[0].reset();
                    e.disabled = false;
                    location.reload(); 
                } else {
                    alert(res.message);
                    e.disabled = false;
                }
            },
            error: function () {
                alert('{{ __('An error occurred while updating the category.') }}');
                e.disabled = false;
            }
        });
    }
    function edit(e, id) {

        var url = `${addURL}/${id}`;

        $('#updateBTN').attr('data-id', id);

        $.get(url, (res) => {
            if (res.code == 200) {
                $("#addBTN").trigger('click');
                $('#saveBTN').hide();
                $('#updateBTN').show();

                var admin = res.data;
                var admin_level = $('#stat').val(admin.status);
                var name = $('input[name=name]').val(admin.name);
      
            } else {
                alert(res.message)

            }
        })

    }


    function toggleStatus(id, element, status) {
        console.log(element,"elementelementelement")
    const confirmationMessage = `{{ __('Are you sure you want to toggle the status of this category?') }}`;
    if (!confirm(confirmationMessage)) {
        return;
    }
        var formData = new FormData();
        formData.append('status', +(!status));
    
        var url = `${addURL}/${id}`;
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.code === 200) {
                alert(res.message);

                // Update the dropdown text dynamically
                const dropdownItem = $(element);
                const currentText = dropdownItem.text().trim();

                if (currentText === '{{ __('Inactive') }}') {
                    dropdownItem.text('{{ __('Activate') }}');
                    // Update the status badge dynamically
                    $(element).closest('tr').find('.badge').removeClass('badge-soft-success').addClass('badge-soft-danger').text('{{ __('Inactive') }}');
                } else {
                    dropdownItem.text('{{ __('Inactive') }}');
                    // Update the status badge dynamically
                    $(element).closest('tr').find('.badge').removeClass('badge-soft-danger').addClass('badge-soft-success').text('{{ __('Active') }}');
                }
            } else {
                alert(res.message);
            }
        },
        error: function () {
            alert('{{ __('An error occurred while updating the status.') }}');
        }
    });
}
</script>
@endsection


