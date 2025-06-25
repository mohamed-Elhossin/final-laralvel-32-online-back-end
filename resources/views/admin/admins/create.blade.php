@extends('admin.layout.app')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">List Admins
                            <a class="btn btn-info float-end" href="{{ route('admin.index') }}">Back </a>
                        </h5>
                        {{-- User + admin --}}
                        <!-- Vertical Form -->
                        <form method="post" action="{{ route('admin.store') }}" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Admin Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4">
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">position</label>
                                <input type="text" class="form-control" name="position" id="inputAddress"
                                    placeholder="position">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
