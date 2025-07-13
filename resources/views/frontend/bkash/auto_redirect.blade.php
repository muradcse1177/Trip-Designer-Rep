@extends('frontend.layout.body')
@section('title', 'Redirecting to bKash')
@section('content')
    <div id="main-wrapper">
        <section class="py-4 gray-simple position-relative">
            <div class="container py-5 bg-primary bg-opacity-10 rounded">
                @if(isset($bkashData))
                    <div class="text-center">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <h5 class="text-primary">Please wait, we are redirecting you to bKash...</h5>

                        <form id="bkashPaymentForm" method="POST" action="{{ route('bkash.create') }}">
                            @csrf
                            <input type="hidden" name="amount" value="{{ $bkashData['amount'] }}">
                            <input type="hidden" name="payerReference" value="{{ $bkashData['phone'] }}">
                            <input type="hidden" name="merchantInvoiceNumber" value="{{ $bkashData['tran_id'] }}">
                        </form>
                    </div>

                    <script>
                        setTimeout(function () {
                            document.getElementById('bkashPaymentForm').submit();
                        }, 1000);
                    </script>
                @else
                    <div class="alert alert-danger text-center">
                        <h5>Session expired</h5>
                        <p>Please go back and try again.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Home</a>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

