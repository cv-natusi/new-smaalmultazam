@push('style')
    <style>
        #page-title {
            background-image: url("{{asset('assets/img/web/PageTitle.png')}}");
            background-repeat: no-repeat;
            background-position-x: 50%;
            background-position-y: center;
            background-size: cover;
            margin-top: -1.7rem;
        }
    </style>
@endpush

<section id="page-title" class="page-title-ml pt-5 pb-5">
    <div class="wrapper mt-0 pt-0">
        <h2 class="large text-center mt-auto mb-auto align-middle text-light-brown">{{strtoupper($curNav)}}</h2>
    </div>
</section><!-- #page-title -->