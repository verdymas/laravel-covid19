@extends('errors.base')
@section('title', 'Access Forbidden')

@section('content')
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="error-page">
            <h2 class="headline text-warning"> 403</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Access Forbidden.</h3>

                <p>
                    The request has not been applied because it lacks valid authentication credentials for the target
                    resource.
                </p>
                <button class="btn btn-link p-0" onclick="history.back();">Return to Home <i class="fas fa-angle-double-right"></i></button>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </div>
@endsection
