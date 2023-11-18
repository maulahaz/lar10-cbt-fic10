@extends('layouts.backend')

@section('title', 'Bank Soal')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Bank Soal</h1>

                <div class="section-header-button">
                    <a href="{{ route('soal.create') }}" class="btn btn-primary">Add New</a>
                </div>

                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Bank Soal</div>
                </div>
            </div>

            <div class="section-body">
                <!-- <h2 class="section-title">Section Title</h2>
                <p class="section-lead">Section Sub-Title</p> -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Manage Bank Soal</h4>
                                
                                <div class="card-header-form">
                                    <form>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control"
                                                placeholder="Search">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>id</th>
                                            <th>Soal</th>
                                            <th>Opsi A</th>
                                            <th>Opsi B</th>
                                            <th>Opsi C</th>
                                            <th>Opsi D</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($soals as $soal)
                                            <tr>

                                                <td>{{ $soal->id }}
                                                </td>
                                                <td>
                                                    {{ $soal->pertanyaan }}
                                                </td>
                                                <td>
                                                    {{ $soal->opsi_a }}
                                                </td>
                                                <td>{{ $soal->opsi_b }}</td>
                                                <td>{{ $soal->opsi_c }}</td>
                                                <td>{{ $soal->opsi_d }}</td>

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="{{ route('soal.edit', $soal->id) }}"
                                                            class="btn btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" data-id="{{$soal->id}}" class="btn btn-danger btn-icon ml-2 swal-confirm"><i class="fas fa-times"></i>

                                                        <form action="{{ route('soal.destroy', $soal->id) }}" method="POST" id="delete_data_{{$soal->id}}">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        </form>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="float-right mr-3">
                                    {{ $soals->withQueryString()->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('stisla/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('stisla/js/page/components-table.js') }}"></script>
    <script src="{{ asset('stisla') }}/library/sweetalert/dist/sweetalert.min.js"></script>

@endpush

@push('after-scripts')
    <script>
       $(".swal-confirm").click(function(e) {
          var id = e.currentTarget.dataset.id;
          swal({
              title: 'Are you sure?',
              text: 'Once deleted, you will not be able to recover this data!',
              icon: 'warning',
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  swal('Poof!, Data successfully deleted!', {
                    icon: 'success',
                  });
                  $(`#delete_data_${id}`).submit();
              }
            });
        });
    </script>
@endpush
