@extends('admin.layouts.layouts')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование поста</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование поста {{ $post->title }}</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           value="{{ $post->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Цитата</label>
                                    <textarea
                                        name="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="description"
                                        rows="5"
                                        placeholder="Цитата"
                                    >{{ $post->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Контент</label>
                                    <textarea
                                        name="content"
                                        class="form-control @error('content') is-invalid @enderror"
                                        id="content"
                                        rows="5"
                                        placeholder="Цитата"
                                    >{{ $post->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Категория</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach($categories as $k => $v)
                                            <option
                                                value="{{ $k }}"
                                                @if($k == $post->category_id) selected @endif>{{$v }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Теги</label>
                                    <select
                                        name="tags[]"
                                        id="tags"
                                        class="select2"
                                        multiple="multiple"
                                        style="width: 100%"
                                        data-placeholder="fdfd">
                                        @foreach($tags as $k => $v)
                                            <option
                                                value="{{ $k }}"
                                                @if(in_array($k, $post->tags->pluck('id')->all()))
                                                    selected
                                                @endif
                                            >{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Файл</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" class="custom-file-input"
                                                   id="thumbnail">
                                            <label class="custom-file-label" for="thumbnail">Выберете файл</label>
                                        </div>
                                    </div>
                                    <div><img src="{{ $post->getImage() }}" alt="" class="img-thumbnail"
                                              width="200"></div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

