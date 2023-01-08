@foreach ($lsbinhluancha as $key => $value)
    <div class="coment-area">
        <ul class="we-comet">
            <li>
                <div class="comet-avatar">
                    <img src="{{ URL($value->hinh_dai_dien) }}" alt="">
                </div>
                <div class="we-comment">
                    <div class="coment-head">
                        <h5><span>{{ $value->ten }}</span></h5>
                        <span>{{date('j/m/Y', strtotime($value->created_at))}}</span>
                        <button class="we-reply" title="trả lời" name="we-repl{{ $value->id }}"
                            id="we-reply{{ $value->id }}" onclick="form_tra_loi_binh_luan({{ $value->id }})">
                            <i class="fa fa-reply"></i>
                        </button>
                    </div>
                    <p>{{ $value->noi_dung }}</p>
                </div>
                
                @foreach ($lsbinhluancon as $key2 => $value2)
                    @if ($value2->id_binh_luan_cha == $value->id)
                        <ul>
                            <li>
                                {{-- <a href="">có 2 phản hồi</a>
                                @break --}}
                                <div class="comet-avatar">
                                    <img src="{{ URL($value2->hinh_dai_dien) }}" alt="">
                                </div>
                                <div class="we-comment">
                                    <div class="coment-head">
                                        <h5><span>{{ $value2->ten }}</span></h5>
                                        <span>{{date('j/m/Y', strtotime($value2->created_at))}}</span>
                                        <button class="we-reply" title="trả lời" name="we-reply{{ $value->id }}"
                                            id="we-reply{{ $value->id }}"
                                            onclick="form_tra_loi_binh_luan({{ $value->id }})">
                                            <i class="fa fa-reply"></i>
                                        </button>
                                    </div>
                                    <p>{{ $value2->noi_dung }}</p>
                                </div>
                            </li>
                        </ul>
                    @endif
                 
                @endforeach

            </li>
        </ul>
        <div class="post-comt-box rep-commment" id="rep-commment{{ $value->id }}">
            <div class="coment-area">
                <ul class="we-comet">
                    <li>
                        <input type="hidden" name="idbaiviet" id="idbaiviet" value="{{ $id_bai_viet }}">
                        <div id="rep-binh-luan-bai-viet">
                            <div class="we-comment-binhluan">
                                <textarea placeholder="Viết bình luận..." id="noidungbinhluan{{ $value->id }}" name="noidungbinhluan"
                                    class="noidungbinhluan"></textarea>
                                <div class="add-smiles">
                                    <div class="guibinhluan">
                                        <button class="btnbinhluan" id="btnbinhluan" name="btnbinhluan"
                                            onclick="rep_binh_luan_bai_viet({{ $id_bai_viet }},{{ $value->id }}, {{$trang}})">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </li>
                </ul>

            </div>
        </div>
    </div>
@endforeach
@if ($lsbinhluancha->hasPages())


    <div class="product__pagination phan-trang text-center">
        @if ($trang != 1)
            <a onclick="load_binh_luan(1)"><i class="fa fa-long-arrow-left"></i></a>
        @endif

        {{-- @for ($i = 1; $i <= $lastPage; $i++)
            <a id="page{{ $i }}" class="" onclick="load_binh_luan({{ $i }})">{{ $i }}</a>
        @endfor --}}
        @for ($i = 1; $i <= $lastPage; $i++)
            @if ($i == $trang || $i == $trang + 1 || $i == $trang + 2||$i == $trang - 1 ||$i == $trang - 2 )
                <a id="page{{ $i }}" class="" onclick="load_binh_luan({{ $i }})">{{ $i }}</a>
            @endif
          
        @endfor

        @if ($trang != $lastPage)
            <a onclick="load_binh_luan({{ $lastPage }})"><i class="fa fa-long-arrow-right"></i></a>
        @endif
    </div>
@endif
