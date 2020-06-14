@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Enter OTP</div>
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif
                @if (Session::has('msg'))
                     <div class="alert alert-success">{{ Session::get('msg') }}</div>
                @endif
                <div class="card-body">
                  <form action="verifyOTP" method="post">
                   @csrf
                   <div class="form-group">
                        <label for="otp">Your OTP</label>
                        <input type="text" name="otp" id="otp" class="form-control" required/>
                        <input type="submit" value="Verify" class="btn btn-info mt-2">
                        <a  href="/resend" class="btn btn-secondary mt-2">Resend</a>
                        
                   </div>
                  </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
