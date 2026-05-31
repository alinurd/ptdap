{{-- HUBUNGI KAMI (Section homepage & halaman contact) --}}
<section class="contact-section">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Hubungi Kami</h2>
        </div>

        <div class="row g-4">
            {{-- INFO KONTAK --}}
            <div class="col-md-5">
                <div class="contact-info-item">
                    <div class="icon"><i class="ti ti-map-pin"></i></div>
                    <div>
                        <h6>Lokasi</h6>
                        <p>{{ $setting?->address ?? 'Gedung Sentra Medika Lt.2 Bandara Soekarno-Hatta' }}</p>
                        @if($setting?->latitude && $setting?->longitude)
                        <div class="contact-map mt-2">
                            <iframe
                                src="https://maps.google.com/maps?q={{ $setting->latitude }},{{ $setting->longitude }}&output=embed"
                                allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="icon"><i class="ti ti-world"></i></div>
                    <div>
                        <h6>Website/eMail</h6>
                        <p>{{ $setting?->website ?? '-' }}<br>{{ $setting?->email ?? '-' }}</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <div class="icon"><i class="ti ti-brand-whatsapp"></i></div>
                    <div>
                        <h6>Whatsapp</h6>
                        <p>{{ $setting?->whatsapp ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="col-md-7">
                <form id="contactForm" class="contact-form">
                    @csrf
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subjek</label>
                        <input type="text" name="subjek" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Pertanyaan</label>
                        <textarea name="pesan" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="text-end">
                        <button type="button" id="btnKirim" onclick="kirimPesan()" class="btn-contact">
                            <span id="btnText">Setuju</span>
                            <span id="btnLoad" class="d-none">
                                <span class="spinner-border spinner-border-sm me-1"></span>Mengirim...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function kirimPesan() {
    const form = document.getElementById('contactForm');
    let ok = true;
    form.querySelectorAll('[required]').forEach(el => { if (!el.value.trim()) ok = false; });
    if (!ok) return swAlert('error', 'Silakan isi semua formulir yang wajib diisi.');

    const email = form.querySelector('[name=email]').value;
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) return swAlert('error', 'Format email tidak valid.');

    document.getElementById('btnKirim').disabled = true;
    document.getElementById('btnText').classList.add('d-none');
    document.getElementById('btnLoad').classList.remove('d-none');

    $.ajax({
        type: 'POST',
        url: "{{ route('guest.contact.send') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(res) {
            if (res.status === 'success') {
                swAlert('success', res.message);
                form.reset();
            } else {
                swAlert('error', res.message ?? 'Terjadi kesalahan.');
            }
        },
        error: function() { swAlert('error', 'Gagal mengirim. Silakan coba lagi.'); },
        complete: function() {
            document.getElementById('btnKirim').disabled = false;
            document.getElementById('btnText').classList.remove('d-none');
            document.getElementById('btnLoad').classList.add('d-none');
        }
    });
}
</script>
