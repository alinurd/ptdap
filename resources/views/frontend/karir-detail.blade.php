@extends('frontend.layouts.app')
@section('content')


<div class="page-hero">
    @if($banner?->image)
    <img src="{{ asset($banner->image) }}" alt="Karir">
    @else
    <div class="w-100 h-100" style="background: linear-gradient(135deg,#003d79,#005bb5);"></div>
    @endif
    <div class="overlay"><h1>{{ $karir->judul }}</h1></div>
</div>

<div class="page-breadcrumb">
    <div class="container">
        <nav><ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('guest.home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('guest.karir') }}">Karir</a></li>
            <li class="breadcrumb-item active">{{ $karir->judul }}</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <h2 class="section-title mb-3">{{ $karir->judul }}</h2>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    @if($karir->tanggal_tutup)
                    <span class="karir-meta-badge"><i class="ti ti-calendar me-1"></i>Batas: {{ \Carbon\Carbon::parse($karir->tanggal_tutup)->translatedFormat('d F Y') }}</span>
                    @endif
                </div>

                @if($karir->persyaratan)
                <h5 class="fw-bold mb-2" style="color:var(--navy,#003d79);">Persyaratan</h5>
                <div class="mb-4" style="color:#555; line-height:1.8;">{!! $karir->persyaratan !!}</div>
                @endif

                @if($karir->deskripsi)
                <h5 class="fw-bold mb-2" style="color:var(--navy,#003d79);">Deskripsi Pekerjaan</h5>
                <div class="mb-4" style="color:#555; line-height:1.8;">{!! $karir->deskripsi !!}</div>
                @endif
            </div>

            <div class="col-lg-5">
                @if($karir->image)
                <div class="karir-detail-image">
                    <img src="{{ asset($karir->image) }}" alt="{{ $karir->judul }}" class="img-fluid rounded">
                </div>
                @endif

                @if($showApplyForm)
                <div class="karir-apply-box">
                    <h5 class="fw-bold mb-3" style="color:var(--navy,#003d79);">Formulir Lamaran</h5>
                    <form id="applyForm" enctype="multipart/form-data">
                        @foreach($karir->formFields as $field)
                        <div class="mb-3">
                            <label class="form-label">{{ $field->label }} @if($field->is_required)<span class="text-danger">*</span>@endif</label>

                            @if($field->type === 'textarea')
                                <textarea class="form-control" name="answers[{{ $field->id }}]" rows="3" @required($field->is_required)></textarea>
                            @elseif($field->type === 'select')
                                <select class="form-control" name="answers[{{ $field->id }}]" @required($field->is_required)>
                                    <option value="">- Pilih -</option>
                                    @foreach($field->optionList() as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endforeach
                                </select>
                            @elseif($field->type === 'radio')
                                @foreach($field->optionList() as $opt)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $field->id }}]" id="field{{ $field->id }}_{{ $loop->index }}" value="{{ $opt }}" @required($field->is_required)>
                                    <label class="form-check-label" for="field{{ $field->id }}_{{ $loop->index }}">{{ $opt }}</label>
                                </div>
                                @endforeach
                            @elseif($field->type === 'checkbox')
                                @foreach($field->optionList() as $opt)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="answers[{{ $field->id }}][]" id="field{{ $field->id }}_{{ $loop->index }}" value="{{ $opt }}">
                                    <label class="form-check-label" for="field{{ $field->id }}_{{ $loop->index }}">{{ $opt }}</label>
                                </div>
                                @endforeach
                            @elseif($field->type === 'file')
                                <input type="file" class="form-control" name="answers[{{ $field->id }}]" @required($field->is_required)>
                            @else
                                <input type="text" class="form-control" name="answers[{{ $field->id }}]" @required($field->is_required)>
                            @endif
                        </div>
                        @endforeach

                        <button type="submit" id="applySubmit" class="btn-karir-apply w-100 border-0">Kirim Lamaran</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
.karir-meta-badge {
    background: #e7f0fb;
    color: var(--navy, #003d79);
    font-size: 13px;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 20px;
}
.karir-apply-box {
    background: #f8f9fb;
    border: 1px solid #e4e8ee;
    border-radius: 10px;
    padding: 24px;
}
.karir-detail-image img {
    width: 100%;
    border-radius: 10px;
}
.btn-karir-apply {
    display: inline-block;
    text-align: center;
    background: #1c7c4f;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 14px;
    border-radius: 6px;
    text-decoration: none;
    cursor: pointer;
}
.btn-karir-apply:hover { background: #155f3d; color: #fff; }
.btn-karir-apply:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
@endsection

@section('scripts')
<script>
document.getElementById('applyForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('applySubmit');
    btn.disabled = true;
    btn.textContent = 'Mengirim...';

    const formData = new FormData(this);
    try {
        const response = await fetch("{{ route('guest.karir.apply', $karir->slug) }}", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        });
        const res = await response.json();
        if (response.ok && res.status === 'success') {
            swAlert('success', res.message);
            this.reset();
        } else {
            const message = res.message || (res.errors ? Object.values(res.errors)[0][0] : 'Terjadi kesalahan, silakan coba lagi.');
            swAlert('error', message);
        }
    } catch (err) {
        swAlert('error', 'Terjadi kesalahan, silakan coba lagi.');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Kirim Lamaran';
    }
});
</script>
@endsection
