@extends('admin.layout.app')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">List Admins
                            <a class="btn btn-info float-end" href="{{ route('admin.create') }}"> Add New </a>
                        </h5>

                        <!-- Default Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th colspan="3">Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->position }}</td>
                                        <th><a href="{{ route('admin.show', $item->id) }}"> Show </a></th>
                                        <th><a href="{{ route('admin.edit', $item->id) }}"> Edit </a></th>
                                        <th><a href="{{ route('admin.destroy', $item->id) }}"> Remove </a></th>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                </div>


            </div>
    </section>
@endsection
