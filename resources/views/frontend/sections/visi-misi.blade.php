<section class="visi-section"
    style="
        background-image:url('{{ asset('assets/img/material/home-ptdap-02.jpg') }}');
        background-size:cover;
        background-position: center 100%;
             min-height:400px;
    ">
        <div class="container text-center">
        @if($company?->vision)
            <blockquote>
                {!! $company->vision !!}
            </blockquote>
        @endif
    </div>
</section>