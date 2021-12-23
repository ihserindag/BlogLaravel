@extends('back.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
                <!-- Button trigger modal -->



            </div>
            <div class="card-body">
                <form action="{{route('admin.category.create')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Kategori Adı:</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary ">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category )

                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>

                                <td>
                                    <input class="switch" category-id="{{$category->id}}" type="checkbox" data-offstyle="danger" data-onstyle="success" data-toggle="toggle" data-on="Aktif" data-off="Pasif" @if ($category->status==1) checked @endif>

                                </td>
                                <td>


                                    <a  category-id="{{$category->id}}"  title="Düzenle" class="btn btn-sm btn-primary edit-click"><i class="fa fa-pen"></i></a>

                                    <a category-id="{{$category->id}}" category-name="{{$category->name}}" category-count="{{$category->articleCount()}}" title="Sil" class="btn btn-sm btn-danger remove-click"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal  edit-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Kategoriyi Düzenle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('admin.category.update')}}" method="POST">
            @csrf
              <div class="form-group">
                  <label for="">Kategori Adı</label>
                  <input id="category" type="text" name="category" class="form-control">
                  <input type="hidden" name="id" id="category_id">
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <button type="submit" class="btn btn-primary">Güncelle</button>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal bitim -->


<!-- Modal  delete-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Kategoriyi Sil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="modal-body">
            <div id="articleAlert" class="alert alert-danger">

            </div>
        </div>


        <div class="modal-footer">
            <form action="{{route('admin.category.delete')}}" method="POST">
                @csrf
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <input type="hidden" name="id" id="deleteId">
                <button id="deleteButon" type="submit" class="btn btn-danger">Sil</button>
        </form>
        </div>
    </form>
      </div>
    </div>
  </div>

<!-- Modal bitim -->

@endsection

@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function() {

        $('.remove-click').click(function(){
            id=$(this)[0].getAttribute('category-id');
            count=$(this)[0].getAttribute('category-count');
            name=$(this)[0].getAttribute('category-name');
            $('#deleteButon').show();
            if(id==1){
                $('#articleAlert').html(name+' Kategorisi sabit kategoridir. Silinen diğer kategorilere ait makaleler buray eklenecektir.');
                $('#modal-body').show();
                $('#deleteButon').hide();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteId').val(id);
            if(count>0)
            {
                $('#modal-body').show();
                $('#articleAlert').html('Bu kategoriye ait '+count+ ' makale bulunmaktadır. Silmek istediğinizden emin misiniz.');
            }else
            {
                $('#modal-body').hide();
            }
            $('#deleteModal').modal();
        });
        $('.edit-click').click(function(){
            $('#modal-body').show();
            id=$(this)[0].getAttribute('category-id');
            $.ajax({
                type:'GET',
                url:'{{route('admin.category.getData')}}',
                data:{id:id},
                success:function(data)
                {
                    $('#category').val(data.name);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            })
        });


      $('.switch').change(function() {
        id=$(this)[0].getAttribute('category-id');
        statu=$(this).prop('checked');
        $.get("{{route('admin.category.switch')}}",{id:id,statu:statu},function(data,status){}
        )
      })
    })
  </script>
@endsection
