<div class="col-12 col-md-10 spacer p-top-xs font-rubik">
    <div class="title  spacer p-top-xs p-bottom-xs">
        <h3 class="font-weight-bold">{{$detail->judul}}</h3>
    </div>
    @if ($curMenu!='Praktek Baik Guru')
    <div class="img object-fit">
        <div class="object-fit-cover">
            {{-- <img src="http://localhost/elearning-smaalmultazam/public/{{$pathGambar.$detail->gambar}}" alt="Assessing the Maturity of Your Data Management in Industry"> --}}
            <img src="{{ asset($pathGambar.$detail->gambar)}}" alt="Assessing the Maturity of Your Data Management in Industry">
        </div>
    </div>
    @endif
    <div class="description clearfix spacer p-top-xs">
        {!!$detail->isi!!}
    </div>
    @if ($curMenu=='Praktek Baik Guru')
    <hr>
    @foreach ($detail->praktek_baik_guru_file as $item)
    <div class="alert alert-info fade show alertFile" role="alert">
        <i class='bx bx-file'></i> <a href="https://learning.smaalmultazam-mjk.sch.id/guru/praktek-baik-guru/downloadFile/{{$item->id_praktek_baik_guru_file}}" target='_blank' class="alert-link"><strong><u>{{$item->original_name}}</u></strong></a>
    </div>
    @endforeach
    @endif
    <div class="spacer p-top-xs">
        <a title="View all news" class="btn btn-outline-secondary btn" href="{{ route(Str::camel($curNav).'.'.Str::camel($curMenu)) }}"><i class='bx bx-left-arrow-circle'>Kembali</i></a>
    </div>
</div>