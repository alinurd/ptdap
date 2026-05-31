@extends('admin.layouts.app', ['title' => 'About Us', 'ckeditor' => true])

@section('content')
    <div class="card shadow">
        <div class="card-body pl-0 pr-0">
            @php
                // Access the first item from the array
                $company = $data[0] ?? null;
            @endphp
            
            <div class="row p-2">
                <div class="col-12">
                    <h3><b>About Us</b></h3>
                </div>
            </div>
            
            <div class="row p-2">
                <div class="col-12">
                    <form class="form" id="formData">
                        @csrf
                        
                        @if($company)
                            {{-- Add hidden field for ID if needed --}}
                            <input type="hidden" name="id" value="{{ $company['id'] }}">
                            
                            <div class="form-group mb-3">
                                <label class="form-label" for="about">About Us</label>
                                <textarea id="about" class="form-control" placeholder="About Us" 
                                          name="about" required>{{ old('about', $company['about']) }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label" for="review">Company Review</label>
                                <textarea id="review" class="form-control" placeholder="Company Review" 
                                          name="review" required>{{ old('review', $company['review']) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="vision">Vision</label>
                                <textarea id="vision" class="form-control" placeholder="Company Vision" 
                                          name="vision">{{ old('vision', $company['vision']) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="mission">Mission</label>
                                <textarea id="mission" class="form-control" placeholder="Company Mission" 
                                          name="mission">{{ old('mission', $company['mission']) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="service">Services</label>
                                <textarea id="service" class="form-control" placeholder="Company Services" 
                                          name="service">{{ old('service', $company['service']) }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="lisensi">License</label>
                                <textarea id="lisensi" class="form-control" placeholder="Company License" 
                                          name="lisensi">{{ old('lisensi', $company['lisensi']) }}</textarea>
                            </div> 
                            <div class="form-group mb-3">
                                <label class="form-label" for="sisko">Sistem Komunikasi</label>
                                <textarea id="sisko" class="form-control" placeholder="Company License" 
                                          name="sisko">{{ old('sisko', $company['sisko']) }}</textarea>
                            </div> 

                            {{-- Status Toggle --}}
                            <div class="form-group mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input switch-input" type="checkbox" 
                                           id="status" name="status" value="1"
                                           {{ $company['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        {{ $company['status'] == 1 ? 'Active' : 'Inactive' }}
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <div class="border rounded p-2">
                                        <label class="form-label mb-1"> License Holder </label>
                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center px-3">
                                            <div id="holder-logo" class="mb-1 mb-md-0">
                                                @if($company['image'])
                                                    <img src="{{ asset($company['image']) }}" style="max-height: 110px; width:100%;" alt="Featured Image">
                                                @else
                                                    <img src="{{ asset('assets/img/noimage.jpg') }}" style="max-height: 110px; width:100%;" alt="No Image">
                                                @endif
                                            </div>
                                            <div>
                                                <small class="text-muted">
                                                Recommended Resolution 300 x 150 pixel</small>
                                                <div class="input-group">
                                                    <a data-input="thumbnail-logo" data-preview="holder-logo" class="btn btn-primary text-white lfm">
                                                        <i class="menu-icon tf-icons ti ti-photo"></i> Choose
                                                    </a>
                                                    <input id="thumbnail-logo" class="form-control bg-secondary-subtle" type="text" name="image" value="{{ $company['image'] }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                No company data found.
                            </div>
                        @endif

                        <hr>

                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <div>
                                    <button type="button" id='submit' onclick="saveData()"
                                            class="btn btn-outline-primary">
                                        <div id="simpan" class="">
                                            <i data-feather="save" class="me-1"></i> Simpan
                                        </div>
                                        <div id="loading" class="d-none">
                                            <span class="spinner-border spinner-border-sm"
                                                  role="status" aria-hidden="true"></span>
                                            <span class="">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Initialize Laravel File Manager (lfm)
        $(document).ready(function() {
            var route_prefix = "/filemanager";
            
            $('.lfm').filemanager('image', {prefix: route_prefix});
            
            $('.lfm').on('fileSelected', function(event, items) {
                console.log('File selected:', items);
            });
        });

        // Initialize CKEditor for all textareas
        CKEDITOR.replace('about', CKEDITORGlobalOptions);
        CKEDITOR.replace('review', CKEDITORGlobalOptions);
        CKEDITOR.replace('vision', CKEDITORGlobalOptions);
        CKEDITOR.replace('mission', CKEDITORGlobalOptions);
        CKEDITOR.replace('service', CKEDITORGlobalOptions);
        CKEDITOR.replace('lisensi', CKEDITORGlobalOptions);
        CKEDITOR.replace('sisko', CKEDITORGlobalOptions);

        $('.switch-input').change(function() {
            let my = $(this).attr('id');
            let lastVal = $('#' + my).val();

            if(parseInt(lastVal) == 1){
                $('#' + my).val('0');
            } else {
                $('#' + my).val('1');
            }
            
            // Update label text
            const label = $(this).siblings('label');
            if($(this).is(':checked')) {
                label.text('Active');
            } else {
                label.text('Inactive');
            }
        });

        function saveData() {
            let hasEmptyRequiredForm = false;
            $('#formData .form-control, #formData .switch-input').filter('[required]:visible').each(function() {
                if($(this).val() == null || $(this).val() == "") {
                    hasEmptyRequiredForm = true;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (hasEmptyRequiredForm) {
                swAlertDialog('error', 'Silakan isi semua formulir yang wajib diisi');
                return;
            }

            const jsonData = {};
            
            // Get all form inputs
            $('#formData input, #formData select, #formData textarea').each(function() {
                let key = $(this).attr('name');
                let val = $(this).val().trim();
                jsonData[key] = val;
            });
            
            // Get CKEditor content
            if(CKEDITOR.instances['review']) {
                jsonData['review'] = CKEDITOR.instances['review'].getData();
            }
            if(CKEDITOR.instances['about']) {
                jsonData['about'] = CKEDITOR.instances['about'].getData();
            }
            if(CKEDITOR.instances['vision']) {
                jsonData['vision'] = CKEDITOR.instances['vision'].getData();
            }
            if(CKEDITOR.instances['mission']) {
                jsonData['mission'] = CKEDITOR.instances['mission'].getData();
            }
            if(CKEDITOR.instances['service']) {
                jsonData['service'] = CKEDITOR.instances['service'].getData();
            }
            if(CKEDITOR.instances['lisensi']) {
                jsonData['lisensi'] = CKEDITOR.instances['lisensi'].getData();
            }
            if(CKEDITOR.instances['sisko']) {
                jsonData['sisko'] = CKEDITOR.instances['sisko'].getData();
            }

            // Add CSRF token
            jsonData['_token'] = '{{ csrf_token() }}';

            $.ajax({
                type: "POST",
                url: "{{ route('admin.master.company.create') }}", {{-- Update this to your correct route --}}
                data: jsonData,
                dataType: 'json',
                beforeSend: function() {
                    $('#submit').prop('disabled', true);
                    $('#loading').removeClass('d-none');
                    $('#simpan').addClass('d-none');
                },
                success: function(res) {
                    if(res.status == 'success') {
                        swAlertDialog('success', 'Data berhasil disimpan');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        swAlertDialog('error', res.message);
                        $('#submit').prop('disabled', false);
                        $('#loading').addClass('d-none');
                        $('#simpan').removeClass('d-none');
                    }
                },
                error: function(xhr) {
                    swAlertDialog('error', 'Terjadi kesalahan. Silakan coba lagi.');
                    $('#submit').prop('disabled', false);
                    $('#loading').addClass('d-none');
                    $('#simpan').removeClass('d-none');
                }
            });
        }

        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) {
                return false;
            }
            return true;
        }
    </script>
@endpush