 <div class="col-lg-4 col-md-5">
     <div class="blog__sidebar">
         <div class="blog__sidebar__search">
             <form action="#">
                 <input type="text" placeholder="Search...">
                 <button type="submit"><span class="icon_search"></span></button>
             </form>
         </div>
         <div class="blog__sidebar__item">
             <h4>Loại bài viêt</h4>
             <ul>
                 <li><a href="#">All</a></li>
                 @foreach ($loaibaiviet as $key => $value)
                     <li><a href="#">{{ $value->loai_bai_viet }} (20)</a></li>
                 @endforeach
             </ul>
         </div>
         <div class="blog__sidebar__item">
             <h4>Các bản tin mới</h4>
             @if ($lsbaivietmoi->count() != null)
                 <div class="blog__sidebar__recent">
                     @foreach ($lsbaivietmoi as $key => $value)
                         <a href="#" class="blog__sidebar__recent__item">
                             <div class="blog__sidebar__recent__item__pic bai-viet-moi">
                                 <img src="{{ URL($value->hinh_anh) }}" alt="">
                             </div>
                             <div class="blog__sidebar__recent__item__text">
                                 <h6>{{$value->tieu_de}} </h6>
                                 <span>{{$value->created_at}}</span>
                             </div>
                         </a>
                     @endforeach
                 </div>
                 
             @else
                 <div>
                     KHÔNG CÓ BÀI VIẾT MỚI GẦN ĐÂY
                 </div>
             @endif

         </div>

     </div>
 </div>
