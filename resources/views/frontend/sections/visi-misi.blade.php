{{-- VISI / MISI --}}
<section class="visi-section">
    <div class="container text-center">
        @if($company?->vision)
        <blockquote>
            {{ $company->vision }}
        </blockquote>
        @endif
    </div>
</section>
