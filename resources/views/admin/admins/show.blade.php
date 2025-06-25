@extends('admin.layout.app')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-5">

                <div class="card">
                    @if ($admin->user->image == null)
                        <img width="50%"
                            src="https://imgs.search.brave.com/gZ3W9GjnWyv8g9cDfw1qrVag80rOPbBgaMDkSRu3z40/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/dmVjdG9yc3RvY2su/Y29tL2kvcHJldmll/dy0xeC8wOC82MS9w/ZXJzb24tZ3JheS1w/aG90by1wbGFjZWhv/bGRlci1saXR0bGUt/Ym95LXZlY3Rvci0y/MzE5MDg2MS5qcGc"
                            alt="">
                    @else
                        <img src="{{ asset('upload/') . $admin->user->image }}" alt="">
                    @endif


                    <div class="card-body">
                        <h5 class="card-title">List Admins
                            <a class="btn btn-info float-end" href="{{ route('admin.index') }}"> Back </a>
                        </h5>



                        <h6> Admin Name : {{ $admin->user->name }} </h6>
                        <h6> Admin email : {{ $admin->user->email }} </h6>

                        <!-- Default Table -->

                        <!-- End Default Table Example -->
                    </div>
                </div>


            </div>
    </section>
@endsection
